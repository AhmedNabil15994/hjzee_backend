<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Report;
use App\Models\Category ;
use Illuminate\Http\Request;
use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Admin\categories\Store;
use App\Http\Requests\Admin\categories\Update;


class CategoryPlaceController extends Controller
{
    public function index($id = null)
    {
        if (request()->ajax()) {
            $categories = Category::where('type','place')->where('parent_id' , $id)->search(request()->searchArray)->paginate(30);
            $html = view('admin.categories_places.table' ,compact('categories'))->render() ;
            return response()->json(['html' => $html]);
        }
        $categories = Category::where('type','place')->latest()->get();
        return view('admin.categories_places.index' ,compact('categories' , 'id'));
    }

    public function export() 
    {
        return Excel::download(new CategoryExport, 'categories.xlsx');
    }

    public function create($id = null)
    {
        $categories = Category::where('type','place')->where('parent_id',null)->latest()->get();
        return view('admin.categories_places.create' , compact('categories' , 'id'));
    }

    public function store(Store $request)
    {
        $category = Category::create($request->validated() );
        Report::addToLog('  اضافه قسم') ;
        if($category->parent_id){
            $url = route('admin.places-categories.index',[$category->parent_id]);
        }else{
            $url = route('admin.places-categories.index');
        }
        return response()->json(['url' => $url]);
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('type','place')->where('parent_id',null)->latest()->get();
        return view('admin.categories_places.edit' , ['category' => $category , 'categories' => $categories]);
    }

    public function update(Update $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());
        Report::addToLog('  تعديل قسم') ;
        if($category->parent_id){
            $url = route('admin.places-categories.index',[$category->parent_id]);
        }else{
            $url = route('admin.places-categories.index');
        }
        return response()->json(['url' => $url]);
    }
    
     public function show($id)
     {
         $category = Category::findOrFail($id);
         $categories = Category::where('type','place')->where('parent_id',null)->latest()->get();
         return view('admin.categories_places.show' , ['category' => $category , 'categories' => $categories]);
     }

    public function destroy($id)
    {
        $category = Category::findOrFail($id)->delete();
        Report::addToLog('  حذف قسم') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Category::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من الاقسام') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
