<?php

namespace App\Models;

class PlaceRating extends BaseModel
{
    const IMAGEPATH = 'ratings' ; 

    protected $fillable = ['user_id','meeting_room_id' ,'rate'];
    protected $casts = [
        'rate'    => 'decimal:1',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function meetingRoom()
    {
        return $this->belongsTo(MeetingRoom::class,'meeting_room_id','id');
    }
}
