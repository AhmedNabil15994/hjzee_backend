<?php

namespace App\Models;

class MeetingRoomTime extends BaseModel
{
    const IMAGEPATH = 'meetingroomtimes' ; 
    protected $fillable = ['meeting_room_id','day' ,'time' ,'price'];

}
