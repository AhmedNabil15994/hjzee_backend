<?php

namespace App\Models;

class ServiceRating extends BaseModel
{
    const IMAGEPATH = 'ratings' ; 

    protected $fillable = ['user_id','service_id' ,'rate'];
    protected $casts = [
        'rate'    => 'decimal:1',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
