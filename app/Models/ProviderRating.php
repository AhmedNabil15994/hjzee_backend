<?php

namespace App\Models;

class ProviderRating extends BaseModel
{
    const IMAGEPATH = 'ratings' ; 

    protected $fillable = ['user_id','provider_id' ,'rate'];
    protected $casts = [
        'rate'    => 'decimal:1',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

}
