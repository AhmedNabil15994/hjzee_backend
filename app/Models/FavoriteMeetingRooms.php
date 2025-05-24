<?php

namespace App\Models;

class FavoriteMeetingRooms extends BaseModel
{
    const IMAGEPATH = 'favorites' ; 

    protected $fillable = ['user_id','meeting_room_id' ];

}
