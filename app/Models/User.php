<?php

namespace App\Models;

use App\Http\Resources\Api\UserResource;
use App\Traits\SmsTrait;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Jobs\SendEmailJob;
use App\Jobs\SendSms;

/**
 * @property mixed country_code
 * @property mixed phone
 */
class User extends Authenticatable
{

    use Notifiable, UploadTrait, HasApiTokens, SmsTrait  , SoftDeletes;

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'lat'         => 'decimal:8',
        'lng'         => 'decimal:8',
        'is_notify'   => 'boolean',
        'is_blocked'  => 'boolean',
        'is_approved' => 'boolean',
        'active'      => 'boolean',
    ];

    protected $fillable = [
        'name',
        'country_code',
        'phone',
        'email',
        'password',
        'birth_date',
        'gender',
        'image',
        'active',
        'is_blocked',
        'is_approved',
        'lang',
        'is_notify',
        'code',
        'code_expire',
        'lat',
        'lng',
        'map_desc',
        'wallet_balance',
    ];

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
                            $query->Where($key, 'like', '%' . $value . '%');
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

    public function replays()
    {
        return $this->morphMany(ComplaintReplay::class, 'replayer');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');

    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable')->latest();
    }

    public function settlements()
    {
        return $this->morphMany(Settlement::class, 'transactionable')->latest();
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

    public function logout()
    {
        $this->tokens()->delete();
        // $this->currentAccessToken()->delete();
        if (request()->device_id) {
            $this->devices()->where(['device_id' => request()->device_id])->delete();
        }
        return true;
    }

    public function devices()
    {
        return $this->morphMany(Device::class, 'morph');
    }

    public function login()
    {
        // $this->tokens()->delete();
        $this->updateUserDevice();
        $this->updateUserLang();
        $token = $this->createToken(request()->device_type??'plain text')->plainTextToken;
        return UserResource::make($this)->setToken($token);
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

    public function updateUserDevice()
    {
        if (request()->device_id) {
            $this->devices()->updateOrCreate([
                'device_id'   => request()->device_id,
                'device_type' => request()->device_type,
            ]);
        }
    }

    public function rooms()
    {
        return $this->morphMany(RoomMember::class, 'memberable');
    }

    public function ownRooms()
    {
        return $this->morphMany(Room::class, 'createable');
    }

    public function joinedRooms()
    {
        return $this->morphMany(RoomMember::class, 'memberable')
            ->with('room')
            ->get()
            ->sortByDesc('room.last_message_id')
            ->pluck('room');
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'user_id','id');
    }

    public function favoriteServices(){
        return $this->belongsToMany(Service::class, 'favorite_services', 'user_id', 'service_id')->Active();
    }

    public function favoriteProviders(){
        return $this->belongsToMany(Provider::class, 'favorite_providers', 'user_id', 'provider_id')->Active();
    }

    public function favoriteMeetingRooms(){
        return $this->belongsToMany(MeetingRoom::class, 'favorite_meeting_rooms', 'user_id', 'meeting_room_id')->Active();
    }

    public static function boot()
    {
        parent::boot();
        /* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */

        static::deleted(function ($model) {
            $model->deleteFile($model->attributes['image'], 'users');
        });
    }

}
