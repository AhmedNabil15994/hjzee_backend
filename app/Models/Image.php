<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;

class Image extends BaseModel
{
    const IMAGEPATH = 'images' ; 
    use HasTranslations;
    protected $fillable = ['name','start_date','end_date','link','type','service_id','place_id','sort','is_active','image'];
    public $translatable = ['name'];
    //type => link,place,service
}
