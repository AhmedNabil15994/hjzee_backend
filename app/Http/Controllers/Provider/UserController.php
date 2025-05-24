<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Provider;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseTrait;
use App\Http\Requests\Provider\Auth\UpdateProfileRequest;
use App\Http\Requests\Provider\Auth\UpdatePasswordRequest;
use App\Http\Requests\Provider\User\CreateEmployeeRequest;
use App\Http\Requests\Provider\User\UpdateEmployeeRequest;

use App\Models\PlaygroundTimes ;
use App\Models\PlaygroundImages ;

class UserController extends Controller
{
    use ResponseTrait;

    public function profile(){
        $provider = auth('provider')->user();
        return view('provider.user.profile',get_defined_vars());
    }

    public function editProfile(){
        return view('provider.user.editProfile');
    }

    public function updateProfile(UpdateProfileRequest $request) {
        $employee = auth('provider')->user();
        $employee->update($request->validated());
        return $this->response('success', __('apis.updated'),['url' => route('provider.profile')]);
    }

    // public function editPlaygroundTimes(){
    //     $playground = auth('provider')->user()->playground;
    //     return view('provider.user.editPlaygroundTimes',get_defined_vars());
    // }

    // public function updatePlaygroundTimes(Request $request) {
    //     $playground = auth('provider')->user()->playground;
    //     $times = [];
    //     $playground->times()->delete();
    //     if(isset($request['times'])){
    //         foreach ($request['times'] as $key => $time) {
    //             $times[$key]  = $time;
    //         }
    //     }
    //     foreach ($times as $key => $value) {
    //         $day_times = [];
    //             if($value['is_full_day'] == '1'){
    //                 for($i = 0 ; $i <= 23; $i++ ){
    //                     $day_times[] = ['playground_id' => $playground->id ,'day' => $key , 'time'=> $i.':00'];
    //                 }
    //             }else{
    //             $value['times'] = array_combine($value['from']??[],$value['to']??[]);
    //                 foreach ($value['times'] as $k => $x) {
    //                         for($i = $k ; $i <= intval($x); $i++ ){
    //                             $day_times[] = ['playground_id' => $playground->id ,'day' => $key , 'time'=> $i.':00'];

    //                         }
    //                 }
    //             }
    //         $day_times = array_map("unserialize", array_unique(array_map("serialize", $day_times)));
    //         (count($day_times))?PlaygroundTimes::insert($day_times) : '';
    //     }
    //     return $this->response('success', __('apis.updated'),['url' => route('playground.profile')]);
    // }

    // public function editPlaygroundImages(){
    //     $playground = auth('provider')->user()->playground;
    //     return view('provider.user.editPlaygroundImages',get_defined_vars());
    // }

    // public function updatePlaygroundImages(Request $request) {
    //     $playground = auth('provider')->user()->playground;
    //     if ($request->hasFile('images')) {
    //         $this->storeFiles($playground, $request->file('images'));
    //     }
    //     return $this->response('success', __('apis.updated'),['url' => route('provider.profile')]);
    // }

    // private function storeFiles($provider, $files)
    // {    
    //     foreach ($files as $file) {
    //         $provider->images()->create(['image' => $file]);
    //     }
    // }
    
    // public function deleteImage(Request $request)
    // {
    //     $image = PlaygroundImages::find($request->image_id);
    //     $image->delete();
    //     return response()->json(['msg' => 'success']);
    // }


    public function editPassword(){
        return view('provider.user.editPassword');
    }

    public function updatePassword(UpdatePasswordRequest $request) {
        $provider = auth('provider')->user();
        $provider->update($request->validated());
        return $this->response('success', __('apis.updated'),['url' => route('provider.profile')]);
      }

    public function employees(){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $employees = Provider::where('parent_id',$provider_id)->get();
        return view('provider.user.employees',get_defined_vars());
    }

    public function addEmployee(){
        return view('provider.user.addEmployee');
    }

    public function createEmployee(CreateEmployeeRequest $request){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        // $employee_permissions = $request->employee_permissions??null; 
        // Provider::create($request->validated()+(['parent_id' => $provider_id,'type'=>auth('provider')->user()->type,'employee_permissions' => $employee_permissions]));
        Provider::create($request->validated()+(['parent_id' => $provider_id,'type'=>auth('provider')->user()->type]));
        return $this->response('success', __('apis.added'),['url' => route('provider.employees')]);
    }

    public function editEmployee(Provider $employee){
        return view('provider.user.editEmployee',get_defined_vars());
    }

    public function updateEmployee(UpdateEmployeeRequest $request,Provider $employee){
        // $employee_permissions = $request->employee_permissions??null; 
        // $employee->update($request->validated()+(['employee_permissions' => $employee_permissions]));
        $employee->update($request->validated());
        return $this->response('success', __('apis.updated'),['url' => route('provider.employees')]);
    }

    public function employeeDetails(Provider $employee){
        return view('provider.user.employeeDetails',get_defined_vars());
    }

    public function deleteEmployee(Request $request,Provider $employee){
        $employee->delete();
        return $this->response('success', __('apis.deleted'),['url' => route('provider.employees')]);
    }
}
