<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseTrait;
use App\Http\Requests\Provider\Service\CreateServiceRequest;
use App\Http\Requests\Provider\Service\UpdateServiceRequest;
use App\Models\Service;
use App\Models\Place;
use App\Models\ServiceImages;
use App\Models\Order;
use App\Models\Options ;
use App\Models\Category;

class ServiceController extends Controller
{
    use ResponseTrait;

    public function services(){
        return view('provider.services.index');
    }
    public function addService(){
        $places = Place::orderBy('name','ASC')->get();
        $options = Options::orderBy('name','ASC')->get();
        $categories = Category::where('type','service')->get();
        return view('provider.services.create',get_defined_vars());
    }

    public function createService(CreateServiceRequest $request){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $service = Service::create($request->validated()+(['provider_id' => $provider_id,'is_active' => 0]));
        if ($request->hasFile('images')) {
            $this->storeFiles($service, $request->file('images'));
        }
        return $this->response('success', __('apis.added'),['url' => route('provider.services')]);
    }

    private function storeFiles($service, $files)
    {    
        foreach ($files as $file) {
            $service->images()->create(['image' => $file]);
        }
    }

    public function editService(Service $service){
        $places = Place::orderBy('name','ASC')->get();
        $options = Options::orderBy('name','ASC')->get();
        $categories = Category::where('type','service')->get();
        return view('provider.services.edit',get_defined_vars());
    }

    public function updateService(UpdateServiceRequest $request,Service $service){
        $service->update($request->validated());
        if ($request->hasFile('images')) {
            $this->storeFiles($service, $request->file('images'));
        }
        return $this->response('success', __('apis.updated'),['url' => route('provider.services')]);
    }

    public function serviceDetails(Service $service){
        $places = Place::orderBy('name','ASC')->get();
        $options = Options::orderBy('name','ASC')->get();
        $categories = Category::where('type','service')->get();
        return view('provider.services.show',get_defined_vars());
    }

    public function deleteService(Request $request,Service $service){
        $service->delete();
        return $this->response('success', __('apis.deleted'),['url' => route('provider.services')]);
    }

    public function deleteImage(Request $request)
    {
        $image = ServiceImages::find($request->image_id);
        $image->delete();
        return response()->json(['msg' => 'success']);
    }

}
