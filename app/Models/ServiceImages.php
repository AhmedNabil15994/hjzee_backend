<?php

namespace App\Models;

class ServiceImages extends BaseModel
{
    const IMAGEPATH = 'serviceimages' ; 

    protected $fillable = ['service_id' ,'image'];

}
