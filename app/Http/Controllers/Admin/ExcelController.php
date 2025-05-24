<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\MasterExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin;
use App\Models\adminReports ;

class ExcelController extends Controller
{
    public function __construct()
    {
        ob_end_clean(); // this
        ob_start(); // and this
    }

    public function master($export, Request $request)
    {
        $data =  $this->$export($request);
        return $this->masterExport($export, $data['cols'], $data['values']);
    }

    public function User()
    {
        return [
            'cols' => ['#', __('admin.name'), __('admin.email'), __('admin.phone')],
            'values' =>  ['id', 'name', 'email', 'full_phone']
        ];
    }

    public function Category()
    {
        return [
            'cols' => ['#', __('admin.name'), __('admin.followed_category')] , 
            'values' => ['id', 'name', 'followed_category'] , 
        ] ;
    }
    public function Country()
    {
        return [
            'cols' => ['#', __('admin.name'), __('admin.key')] , 
            'values' => ['id', 'name', 'key' ] , 
        ] ;
    }
    public function Admin()
    {
        return [
            'cols' => ['#', __('admin.name'), __('admin.email') , __('admin.phone')] , 
            'values' => ['id', 'name', 'email' , 'phone'] , 
        ] ;
    }
    public function Region()
    {
        return [
            'cols' => ['#', __('admin.name'), __('admin.country')] , 
            'values' => ['id', 'name', 'country.name'] , 
        ] ;
    }
    public function City()
    {
        return [
            'cols' => ['#', __('admin.name'), __('admin.region')] , 
            'values' => ['id', 'name', 'region.name'] , 
        ] ;
    }

    public function Provider()
    {
        return [
            'cols' => ['#', __('admin.name'), __('admin.type'), __('admin.email'),__('admin.phone'),__('admin.job'),__('admin.rate'),__('admin.num_courses'),__('admin.num_lessons')],
            'values' =>  ['id', 'name', 'type','email','full_phone','job','rate','num_courses','num_lessons']
        ];
    }

    public function transactionsExport()
    {
        $data = [
            'cols' => [  __('admin.date'),__('admin.transactionable_type'), __('admin.credit'),__('admin.debit'),__('admin.type') ] , 
            'values' => [ 'created_at','transactionable.name','credit','dept','message'] , 
        ] ;

        $superAdmin = Admin::find(1) ;
        $transactions = $superAdmin->transactions()->get(); 

        return Excel::download(new MasterExport($transactions, 'master-excel', ['cols' => $data['cols'], 'values' => $data['values']]), 'admin-transactions-reports-' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }


    public function masterExport($model  , $cols , $values)
    {
        $folderNmae = strtolower(Str::plural(class_basename($model)));
        $model = app("App\Models\\$model");
        $records = $model::latest()->get();
        return Excel::download(new MasterExport($records, 'master-excel', ['cols' => $cols, 'values' => $values]), $folderNmae.'-reports-' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }
}
