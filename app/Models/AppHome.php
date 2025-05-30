<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use Carbon\Carbon;
use App\Http\Resources\Api\Settings\ImageResource;
use App\Http\Resources\Api\Service\ServiceResource;
use App\Http\Resources\Api\Place\PlaceResource;
use App\Http\Resources\Api\Settings\CategoryDetailsResource;

class AppHome extends BaseModel
{
    const IMAGEPATH = 'apphomes' ; 

    use HasTranslations; 
    protected $fillable = [ "title","description","type",'sort','add_dates','start_at','end_at','is_active','display_type','grid_columns_count','records'];
    public $translatable = ['title','description'];
    //display_type => grid or carousel
    const TYPES = [
        'services',
        'places',
        'categories',
        'ads',
        'description',
    ];

    protected $casts = [
        'records'         => 'array',
    ]; 

    public function getTypeTextAttribute() {
        return trans('apis.type_' . $this->type);
      }

        
    public function services(){
        return Service::whereIntegerInRaw('id',$this->records??[])->get();
    }

    public function places(){
        return Place::whereIntegerInRaw('id',$this->records??[])->get();
    }

    public function categories(){
        return Category::whereIntegerInRaw('id',$this->records??[])->orderBy('sort','ASC')->get();
    }

    public function ads(){
        return Image::whereIntegerInRaw('id',$this->records??[])->get();
    }

    public function records(){
        switch ($this->type){
            case 'services':
               return  $records =  ServiceResource::collection($this->services());
            break;
            case 'places':
                return $records = PlaceResource::collection($this->places());
            break;
            case 'categories':
                return $records =  CategoryDetailsResource::collection($this->categories());
                    break;
            case 'ads':
                return $records = ImageResource::collection($this->ads());
            break;
        }
    }

    public function scopePublished($query)
    {
        return $query->where('add_dates', 0)->orWhere(function ($q) {
            $q->where(function ($q) {

                $q->whereDate('start_at', '<=', Carbon::now())
                    ->orWhereNull('start_at');
            })->where(function ($q) {

                $q->whereDate('end_at', '>=', Carbon::now())
                    ->orWhereNull('end_at');
            });
        });
    }

    public function scopeActive($query){
        return $query->where('is_active',1);
    }

}

