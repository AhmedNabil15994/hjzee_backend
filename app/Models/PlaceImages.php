<?php

namespace App\Models;

class PlaceImages extends BaseModel
{
    const IMAGEPATH = 'placeimages' ; 

    protected $fillable = ['place_id' ,'image'];


}
