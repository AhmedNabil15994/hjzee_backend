<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\favorites\Store;
use App\Http\Requests\Admin\favorites\Update;
use App\Models\Favorite ;
use App\Traits\Report;


class FavoriteController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $favorites = Favorite::search(request()->searchArray)->paginate(30);
            $html = view('admin.favorites.table' ,compact('favorites'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.favorites.index');
    }

    public function create()
    {
        return view('admin.favorites.create');
    }


    public function store(Store $request)
    {
        Favorite::create($request->validated());
        Report::addToLog('  اضافه المفضلة') ;
        return response()->json(['url' => route('admin.favorites.index')]);
    }
    public function edit($id)
    {
        $favorite = Favorite::findOrFail($id);
        return view('admin.favorites.edit' , ['favorite' => $favorite]);
    }

    public function update(Update $request, $id)
    {
        $favorite = Favorite::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل المفضلة') ;
        return response()->json(['url' => route('admin.favorites.index')]);
    }

    public function show($id)
    {
        $favorite = Favorite::findOrFail($id);
        return view('admin.favorites.show' , ['favorite' => $favorite]);
    }
    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id)->delete();
        Report::addToLog('  حذف المفضلة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Favorite::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من المفضلة') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
