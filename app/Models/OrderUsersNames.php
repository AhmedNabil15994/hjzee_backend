<?php

namespace App\Models;

class OrderUsersNames extends BaseModel
{
    const IMAGEPATH = 'orderusersnames' ; 

    protected $fillable = ['order_id','name' ];

}
