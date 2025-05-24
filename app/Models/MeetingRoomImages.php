<?php

namespace App\Models;

class MeetingRoomImages extends BaseModel
{
    const IMAGEPATH = 'meetingroomsimages' ; 

    protected $fillable = ['meeting_room_id' ,'image'];

}
