<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use App\Models\Options;

class Service extends BaseModel
{
    const IMAGEPATH = 'services' ; 

    use HasTranslations; 
    protected $fillable = ['name','type','provider_id','place_id','category_id','description','start_date','times','price','offer_price','num_seats','lat','lng','address','options','target_audience','from_age','to_age','rate','num_rating','num_views','num_reservations','allow_notes','is_free','need_confirm','pin','sort','is_active','expire_at'];
    public $translatable = ['name','description','times'];

    protected $casts = [
        'options'         => 'array',
        'target_audience' => 'array',
        'price'           => 'decimal:2',
        'offer_price'     => 'decimal:2',
        'rate'            => 'decimal:1',
        'allow_notes'     => 'boolean',
        'is_free'         => 'boolean',
        'need_confirm'    => 'boolean',  
    ];  


    public function scopeActive($query){
        return $query->where('is_active',1)->where(function($q){
            return $q->whereNull('expire_at')->orwhere('expire_at','>',date('Y-m-d'));
        });
    }

      public function images()
      {
          return $this->hasMany(ServiceImages::class,'service_id','id');
      }
      
      public function provider()
      {
          return $this->belongsTo(Provider::class, 'provider_id', 'id');
      }

      public function place()
      {
          return $this->belongsTo(Place::class, 'place_id', 'id');
      }

      public function category()
      {
          return $this->belongsTo(Category::class, 'category_id', 'id');
      }

      public function ratings()
      {
          return $this->hasMany(ServiceRating::class,'service_id','id');
      }
        
      public function options(){
            return Options::whereIntegerInRaw('id',$this->options??[])->get();
      }
      
}
