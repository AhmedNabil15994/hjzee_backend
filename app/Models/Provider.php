<?php

namespace App\Models;

use App\Traits\SmsTrait;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;
use App\Jobs\SendEmailJob;
use App\Jobs\SendSms;
use App\Http\Resources\Api\UserResource;
class Provider extends Authenticatable
{
    const IMAGEPATH = 'providers' ; 

    use Notifiable, UploadTrait, HasApiTokens, SmsTrait,HasTranslations ;

    protected $hidden = [
        'password',
    ];

    protected $fillable = ['name','parent_id','type','country_code','phone','email','password','gender','job','info','education_info','rate','num_rating','num_courses','num_lessons','image','lang','is_notify','code','code_expire','employee_permissions','notes','expire_at','is_active'];
    public $translatable = ['job','info','education_info'];
    
    protected $casts = [
        'rate'                  => 'decimal:1',
        'employee_permissions'  => 'array',
        'is_active'             => 'boolean',
    ];

    public function scopeActive($query){
        return $query->where('is_active',1);
    }

    public function scopeSearch($query, $searchArray = [])
    {
        $query->where(function ($query) use ($searchArray) {
            if ($searchArray) {
                foreach ($searchArray as $key => $value) {
                    if (str_contains($key, '_id')) {
                        if (null != $value) {
                            $query->Where($key, $value);
                        }
                    } elseif ('order' == $key) {
                    } elseif ('created_at_min' == $key) {
                        if (null != $value) {
                            $query->WhereDate('created_at', '>=', $value);
                        }
                    } elseif ('created_at_max' == $key) {
                        if (null != $value) {
                            $query->WhereDate('created_at', '<=', $value);
                        }
                    } else {
                        if (null != $value) {
                            $query->where(function($query)use($key,$value){
                                $query->where($key, 'like', '%' . $value . '%');
                                $query->orwhereHas('employees', function($q)use($key,$value){
                                    $q->where($key, 'like', '%' . $value . '%');
                                });
                            });

                        }
                    }
                }
            }
        });
        return $query->orderBy('created_at', request()->searchArray && request()->searchArray['order'] ? request()->searchArray['order'] : 'DESC');
    }

    public function setPhoneAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['phone'] = fixPhone($value);
        }
    }

    public function setCountryCodeAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['country_code'] = fixPhone($value);
        }
    }

    public function getFullPhoneAttribute()
    {
        return $this->attributes['country_code'] . $this->attributes['phone'];
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            $image = $this->getImage($this->attributes['image'], 'users');
        } else {
            $image = $this->defaultImage('users');
        }
        return $image;
    }

    public function setImageAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['image']) ? $this->deleteFile($this->attributes['image'], 'users') : '';
            $this->attributes['image'] = $this->uploadAllTyps($value, 'users');
        }
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function markAsActive()
    {
        $this->update(['code' => null, 'code_expire' => null, 'active' => true]);
        return $this;
    }

    public function sendVerificationCode()
    {
        $this->update([
            'code'        => $this->activationCode(),
            'code_expire' => Carbon::now()->addMinute(),
        ]);

        $this->sendCodeAtSms($this->code);
    //   $this->sendEmail($this->code);

        return new UserResource($this->refresh());
    }

    private function activationCode()
    {
        return 1234;
        return mt_rand(1111, 9999);
    }

    public function sendCodeAtSms($code ,$full_phone = null){
        $msg = trans('apis.activeCode');
        dispatch(new SendSms($full_phone ?? $this->full_phone , $msg . $code));
    }

    public function sendEmail($code ,$full_phone = null){
        $msg = __('apis.activeCode');
        $data = ['title' => __('admin.reset_password'),'message' => $msg.$code];
        dispatch(new SendEmailJob($this->email,$data  ));
    }

    public function parent(){
        return $this->belongsTo(self::class,'parent_id');
    }

    public function employees(){
        return $this->hasMany(self::class,'parent_id');
    }

    public function services(){
        return $this->hasMany(Service::class,'provider_id','id')->Active();
    }

    public function places(){
        return $this->hasMany(Place::class,'provider_id','id')->Active();
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');

    }

    public function ratings()
    {
        return $this->hasMany(ProviderRating::class,'provider_id','id');
    }

    public function updateUserLang()
    {
        if (request()->header('Lang') != null
            && in_array(request()->header('Lang'), languages())) {
            $this->update(['lang' => request()->header('Lang')]);
        } else {
            $this->update(['lang' => defaultLang()]);
        }
    }
}
