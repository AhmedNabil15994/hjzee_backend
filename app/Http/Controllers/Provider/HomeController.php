<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Enums\OrderStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(){
        $provider_id = (auth('provider')->user()->parent_id)? auth('provider')->user()->parent_id : auth('provider')->id();
        $orders_count     = Order::where(['provider_id' => $provider_id])->count() ;     
        $new_orders_count         = Order::where('provider_id',$provider_id)
                                        ->where(function($q){
                                            return $q->where('date' ,'>',date('Y-m-d'))
                                                    ->orwhere('date',date('Y-m-d'))->where('time','>',date('H:i:s'));
                                        })
                                        ->count() ; 
        $finished_orders_count    = Order::where('provider_id',$provider_id)
                                    ->where(function($q){
                                        return $q->where('date' ,'<',date('Y-m-d'))
                                                    ->orwhere('date',date('Y-m-d'))->where('time','<',date('H:i:s'));
                                    })
                                     ->count() ; 
       
       $start  = Carbon::now()->subYear();
       $end    = Carbon::now();
       $months = [];
       for ($i = 0; $i <= $start->diffInMonths($end); $i++) {
           $months[] = $start->copy()->addMonths($i)->format('Y-m');
       }
       $lastYearCountByMonth = DB::table('orders')
       ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") AS month_year'), DB::raw('COUNT(*) as total'))
       ->whereBetween('created_at', [$start, $end])
       ->where('provider_id', $provider_id)
       ->groupBy('month_year')
       ->get();
       $lastYearCountByMonth        =  $this->chartData($months, $lastYearCountByMonth);


    //    $time_start  = 0;
    //    $time_end    = 23;
    //    $hours = [];
    //    for ($i = 0; $i <= $time_end; $i++) {
    //        $hours[] = ($i < 10)?'0'.$i : ''.$i;
    //    }
    //    $countReservationsByHour = DB::table('orders')
    //    ->select(DB::raw('DATE_FORMAT(time, "%H") AS hour'), DB::raw('COUNT(*) as total'))
    //    ->where('provider_id', $provider_id)
    //    ->groupBy('hour')
    //    ->get();
    //    $countReservationsByHour        =  null;//$this->chartDataTimes($hours, $countReservationsByHour);
       return view('provider.index.index',get_defined_vars());
    }

    public function chartData($months, $lastYearEarningsByMonth)
    {
        $monthsArray = $lastYearEarningsByMonth->pluck('month_year')->toArray();
        $totalArray = $lastYearEarningsByMonth->pluck('total')->toArray();
        $monthsAndTotalArray = array_combine($monthsArray, $totalArray);
        $values = [];
        foreach ($months as $key => $month){
            if (in_array($month, $monthsArray)){
                $values[$key] =  $monthsAndTotalArray[$month];
            }else{
                $values[$key] = 0;
            }
        }
        return $values;
    }

    public function chartDataTimes($hours, $countReservationsByHour)
    {
        $hoursArray = $countReservationsByHour->pluck('hour')->toArray();
        $totalArray = $countReservationsByHour->pluck('total')->toArray();
        $hoursAndTotalArray = array_combine($hoursArray, $totalArray);
        $values = [];
        foreach ($hours as $key => $hour){
            if (in_array($hour, $hoursArray)){
                $values[$key] =  $hoursAndTotalArray[$hour];
            }else{
                $values[$key] = 0;
            }
        }
        return $values;
    }

}
