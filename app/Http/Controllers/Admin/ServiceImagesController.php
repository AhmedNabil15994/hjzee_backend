<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\serviceimages\Store;
use App\Http\Requests\Admin\serviceimages\Update;
use App\Models\ServiceImages ;
use App\Traits\Report;


class ServiceImagesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $serviceimages = ServiceImages::search(request()->searchArray)->paginate(30);
            $html = view('admin.serviceimages.table' ,compact('serviceimages'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.serviceimages.index');
    }

    public function create()
    {
        return view('admin.serviceimages.create');
    }


    public function store(Store $request)
    {
        ServiceImages::create($request->validated());
        Report::addToLog('  اضافه صور الخدمة') ;
        return response()->json(['url' => route('admin.serviceimages.index')]);
    }
    public function edit($id)
    {
        $serviceimages = ServiceImages::findOrFail($id);
        return view('admin.serviceimages.edit' , ['serviceimages' => $serviceimages]);
    }

    public function update(Update $request, $id)
    {
        $serviceimages = ServiceImages::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل صور الخدمة') ;
        return response()->json(['url' => route('admin.serviceimages.index')]);
    }

    public function show($id)
    {
        $serviceimages = ServiceImages::findOrFail($id);
        return view('admin.serviceimages.show' , ['serviceimages' => $serviceimages]);
    }
    public function destroy($id)
    {
        $serviceimages = ServiceImages::findOrFail($id)->delete();
        Report::addToLog('  حذف صور الخدمة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (ServiceImages::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من صور الخدمة') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
