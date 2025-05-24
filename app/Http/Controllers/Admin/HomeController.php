<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Traits\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\UpdateProfile;
use App\Http\Requests\Admin\Auth\updatePassword;
use Hash ;
class HomeController extends Controller
{
    use Menu ;

    /***************** Ajax *****************/
    public function getMonthsReservationChart(Request $request){
        $daysReservationsArray   = $this->chartDataDays(new Order,$request->month,$request->year);
        return view('admin.dashboard.getMonthsReservationChart' , get_defined_vars());
    }
    /***************** Ajax *****************/


    /***************** dashboard *****************/
    public function dashboard()
    {
        $reservationsArray   = $this->chartData(new Order);
        $daysReservationsArray   = $this->chartDataDays(new Order,date('m'),date('Y'));
        
        $menus          = $this->home() ;
        $introSiteCards = $this->introSiteCards() ;
        $colores        = ['info' , 'danger' , 'warning' , 'success' , 'primary'];
        
        return view('admin.dashboard.index' , get_defined_vars());
    }

    public function profile() {
        return view('admin.admins.profile');
    }

    
    public function updateProfile(UpdateProfile $request) {
        auth('admin')->user()->update($request->validated());
        return back()->with('success' , __('admin.update_successfullay'));
    }
    
    public function updatePassword(updatePassword $request) {
        auth('admin')->user()->update(['password' => $request->password]);
        return back()->with('success' , __('admin.update_successfullay'));
    }

    public function chartData($model)
    {
        $users = $model::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m'); 
        });
        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[$key] = count($value);
        }
        for($i = 1; $i <= 12; $i++){
            $d = ($i < 10 )? date('Y').'-0'.$i : date('Y').'-'.$i;
            if(!empty($usermcount[$d])){
                $userArr[] = $usermcount[$d];
            }else{
                $userArr[] = 0;
            }
        }
        return $userArr ; 
    }
    
    public function chartDataDays($model,$month = 1,$year=2024)
    {
        $users = $model::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d'); 
        });
        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[$key] = count($value);
        }
        for($i = 1; $i <= 31; $i++){
            $d = ($i < 10 )? $year.'-'.$month.'-0'.$i : $year.'-'.$month.'-'.$i;
            if(!empty($usermcount[$d])){
                $userArr[] = $usermcount[$d];
            }else{
                $userArr[] = 0;
            }
        }
        return $userArr ; 
    }


}
