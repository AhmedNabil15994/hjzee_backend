<?php

namespace App\Models;

class FavoriteProviders extends BaseModel
{
    const IMAGEPATH = 'favorites' ; 

    protected $fillable = ['user_id','provider_id' ];

}
