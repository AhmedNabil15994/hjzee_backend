<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\placeimages\Store;
use App\Http\Requests\Admin\placeimages\Update;
use App\Models\PlaceImages ;
use App\Traits\Report;


class PlaceImagesController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $placeimages = PlaceImages::search(request()->searchArray)->paginate(30);
            $html = view('admin.placeimages.table' ,compact('placeimages'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.placeimages.index');
    }

    public function create()
    {
        return view('admin.placeimages.create');
    }


    public function store(Store $request)
    {
        PlaceImages::create($request->validated());
        Report::addToLog('  اضافه صور المكان') ;
        return response()->json(['url' => route('admin.placeimages.index')]);
    }
    public function edit($id)
    {
        $placeimages = PlaceImages::findOrFail($id);
        return view('admin.placeimages.edit' , ['placeimages' => $placeimages]);
    }

    public function update(Update $request, $id)
    {
        $placeimages = PlaceImages::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل صور المكان') ;
        return response()->json(['url' => route('admin.placeimages.index')]);
    }

    public function show($id)
    {
        $placeimages = PlaceImages::findOrFail($id);
        return view('admin.placeimages.show' , ['placeimages' => $placeimages]);
    }
    public function destroy($id)
    {
        $placeimages = PlaceImages::findOrFail($id)->delete();
        Report::addToLog('  حذف صور المكان') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (PlaceImages::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من صور المكان') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
