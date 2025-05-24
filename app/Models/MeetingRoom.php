<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use App\Models\Options;

class MeetingRoom extends BaseModel
{
    const IMAGEPATH = 'meetingrooms' ; 

    use HasTranslations; 
    protected $fillable = ['name','description','place_id','category_id','price','offer_price','num_seats','rate','num_rating','num_views','num_reservations','image','allow_notes','need_confirm','options','pin','sort','is_active'];
    public $translatable = ['name','description'];
   
    protected $casts = [
        'price'           => 'decimal:2',
        'offer_price'     => 'decimal:2',
        'rate'            => 'decimal:1',
        'allow_notes'     => 'boolean',
        'need_confirm'    => 'boolean',
        'options'         => 'array'
    ];

    public function scopeActive($query){
        return $query->where('is_active',1);
    }
    
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    
    public function orders(){
        return $this->hasMany(Order::class, 'meeting_room_id', 'id');
    }

    public function times(){
        return $this->hasMany(MeetingRoomTime::class, 'meeting_room_id', 'id');
    }

    public function options(){
        return Options::whereIntegerInRaw('id',$this->options??[])->get();
    }

    public function images()
    {
        return $this->hasMany(MeetingRoomImages::class,'meeting_room_id','id');
    }

    public function ratings()
    {
        return $this->hasMany(PlaceRating::class,'meeting_room_id','id');
    }

    public function availableTimes(){
        if(request('day')){
            $date = date('Y-m-d',strtotime(request('day')));
            $day = date('l',strtotime(request('day')));
            $reservations_times = $this->orders()->whereNotIn('status',[2,3,4])->where('date',$date)->pluck('time')->toArray(); 
            
            if($date == date('Y-m-d')){
                return $this->times->where('day',$day)->where('time' , '>', date('H:i:s'))->whereNotIn('time', $reservations_times);
            }else{
                return $this->times->where('day',$day)->whereNotIn('time', $reservations_times);
            }

            // return $this->times->where('day',$day)->whereNotIn('time', $reservations_times);
        }else{
            return $this->times;
        }
    }

}
