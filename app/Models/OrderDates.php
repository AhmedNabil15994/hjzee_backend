<?php

namespace App\Models;

class OrderDates extends BaseModel
{
    const IMAGEPATH = 'orderdates' ; 

    protected $fillable = ['order_id','date','time' ];

}
