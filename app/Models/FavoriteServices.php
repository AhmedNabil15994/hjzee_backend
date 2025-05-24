<?php

namespace App\Models;

class FavoriteServices extends BaseModel
{
    const IMAGEPATH = 'favorites' ; 

    protected $fillable = ['user_id','service_id' ];

}
