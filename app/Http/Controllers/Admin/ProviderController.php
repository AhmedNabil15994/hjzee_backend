<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\providers\Store;
use App\Http\Requests\Admin\providers\Update;
use App\Models\Provider ;
use App\Traits\Report;
use App\Models\Country ;
use App\Models\SiteSetting;

class ProviderController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $providers = Provider::search(request()->searchArray)->where('parent_id' , $id)->paginate(30);
            $html = view('admin.providers.table' ,compact('providers','id'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.providers.index',get_defined_vars());
    }

    public function create()
    {
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries)->orderBy('id','ASC')->get();
        $providers = Provider::where('parent_id' , null)->get();
        return view('admin.providers.create',get_defined_vars());
    }


    public function store(Store $request)
    {
        $employee_permissions = $request->employee_permissions??null; 
        Provider::create($request->validated()+(['employee_permissions' => $employee_permissions]));
        Report::addToLog('  اضافه مقدم الخدمة') ;
        return response()->json(['url' => route('admin.providers.index')]);
    }
    public function edit($id)
    {
        $provider = Provider::findOrFail($id);
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries)->orderBy('id','ASC')->get();
        $providers = Provider::where('parent_id' , null)->get();
        return view('admin.providers.edit' ,get_defined_vars());
    }

    public function update(Update $request, $id)
    {
        $employee_permissions = $request->employee_permissions??null; 
        $provider = Provider::findOrFail($id)->update($request->validated()+(['employee_permissions' => $employee_permissions]));
        Report::addToLog('  تعديل مقدم الخدمة') ;
        return response()->json(['url' => route('admin.providers.index')]);
    }

    public function show($id)
    {
        $provider = Provider::findOrFail($id);
        $supported_countries = SiteSetting::where('key','countries')->first()->value??'';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id',$supported_countries)->orderBy('id','ASC')->get();
        $providers = Provider::where('parent_id' , null)->get();
        return view('admin.providers.show' ,get_defined_vars());
    }
    public function destroy($id)
    {
        $provider = Provider::findOrFail($id)->delete();
        Report::addToLog('  حذف مقدم الخدمة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Provider::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من مقدمي الخدمات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
