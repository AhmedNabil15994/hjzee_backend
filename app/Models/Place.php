<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Place extends BaseModel
{
    const IMAGEPATH = 'places' ; 

    use HasTranslations; 
    protected $fillable = ['name','description','category_id','provider_id','city_id','lat','lng','address','num_meeting_rooms','pin','sort','is_active'];
    public $translatable = ['name','description'];
   
    public function scopeActive($query){
        return $query->where('is_active',1);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(PlaceImages::class,'place_id','id');
    }

    public function rooms(){
        return $this->hasMany(MeetingRoom::class, 'place_id', 'id')->Active();
    }

}
