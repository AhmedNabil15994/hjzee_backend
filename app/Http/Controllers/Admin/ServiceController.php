<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\services\Store;
use App\Http\Requests\Admin\services\Update;
use App\Models\Service ;
use App\Traits\Report;
use App\Models\Provider ;
use App\Models\Place;
use App\Models\Category;
use App\Models\ServiceImages ;
use App\Models\Options ;

class ServiceController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $services = Service::search(request()->searchArray)->paginate(30);
            $html = view('admin.services.table' ,compact('services'))->render() ;
            return response()->json(['html' => $html]);
        }
        $providers = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
        $places = Place::orderBy('name','ASC')->get();
        $categories = Category::where('type','service')->get();
        return view('admin.services.index',get_defined_vars());
    }

    public function create()
    {
        $providers = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
        $places = Place::orderBy('name','ASC')->get();
        $categories = Category::where('type','service')->where('parent_id',null)->get();
        $options = Options::orderBy('name','ASC')->get();
        return view('admin.services.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        $allow_notes = ($request->allow_notes)? 1:0;
        $need_confirm = ($request->need_confirm)? 1:0;
        $is_free = ($request->is_free)? 1:0;
        $service = Service::create($request->validated()+(['allow_notes' => $allow_notes,'is_free' => $is_free,'need_confirm' => $need_confirm]));
        if ($request->hasFile('images')) {
            $this->storeFiles($service, $request->file('images'));
        }
        Report::addToLog('  اضافه الخدمة') ;
        return response()->json(['url' => route('admin.services.index')]);
    }
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $providers = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
        $places = Place::orderBy('name','ASC')->get();
        $categories = Category::where('type','service')->where('parent_id',null)->get();
        $options = Options::orderBy('name','ASC')->get();
        return view('admin.services.edit' ,get_defined_vars());
    }

    private function storeFiles($service, $files)
    {    
        foreach ($files as $file) {
            $service->images()->create(['image' => $file]);
        }
    }

    public function update(Update $request, $id)
    {
        $service = Service::findOrFail($id);
        $allow_notes = ($request->allow_notes)? 1:0;
        $is_free = ($request->is_free)? 1:0;
        $need_confirm = ($request->need_confirm)? 1:0;
        $service->update($request->validated()+(['allow_notes' => $allow_notes,'is_free'=>$is_free,'need_confirm' => $need_confirm]));
        if ($request->hasFile('images')) {
            $this->storeFiles($service, $request->file('images'));
        }
        Report::addToLog('  تعديل الخدمة') ;
        return response()->json(['url' => route('admin.services.index')]);
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);
        $providers = Provider::where('parent_id' , null)->orderBy('name','ASC')->get();
        $places = Place::orderBy('name','ASC')->get();
        $categories = Category::where('type','service')->where('parent_id',null)->get();
        $options = Options::orderBy('name','ASC')->get();
        return view('admin.services.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $service = Service::findOrFail($id)->delete();
        Report::addToLog('  حذف الخدمة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Service::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من الخدمات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

    public function deleteImage(Request $request)
    {
        $image = ServiceImages::find($request->image_id);
        $image->delete();
        return response()->json(['msg' => 'success']);
    }
}
