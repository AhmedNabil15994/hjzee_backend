<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Enums\OrderPayType;
use App\Enums\OrderPayStatus;

class Order extends BaseModel {
  use UploadTrait;

  protected $fillable = [
    'order_num', // auto with creating in this boot method
    'type', //0=>service,1=>place
    'user_id',
    'provider_id',
    'service_id',
    'place_id',
    'meeting_room_id',
    
    'date',
    'time',
    'quantity',

    'coupon_id',
    'coupon_num',
    'coupon_type',
    'coupon_value',
    'coupon_amount',
    
    'vat_per',
    'vat_amount',

    'price',
    'final_total',

    'admin_commission_per',
    'admin_commission',

    'status',
    'is_confirmed',

    'pay_type',
    'pay_status',
    'pay_data',

    'notes',

    // 'user_delete',
    // 'provider_delete',
    // 'delegate_delete',
    'admin_delete',
  ];

  protected $casts = [
    'pay_data'          => 'array',
    'coupon_amount'     => 'decimal:3',
    'vat_amount'        => 'decimal:3',
    'price'             => 'decimal:3',
    'final_total'       => 'decimal:3',
    'admin_commission'  => 'decimal:3',
    'is_confirmed'      => 'boolean',
  ];

  public function getQrCodeAttribute() {
    /**
     * generate image file and store with order id
     * composer require simplesoftwareio/simple-qrcode "~4"
     * https://www.simplesoftware.io/#/docs/simple-qrcode
     */
    if (!Storage::exists("images/qrcodes/$this->id")) {
      QrCode::format('png')->generate("$this->id", base_path() . "/storage/app/public/images/qrcodes/$this->id.png");
    }

    return dashboard_url("storage/images/qrcodes/$this->id.png");
  }

  public function getTypeTextAttribute() {
    return trans('order.types_' . OrderType::slug($this->type));
  }

  public function getStatusTextAttribute() {
    return trans('order.status_' . OrderStatus::slug($this->status));
  }

  public function getPayTypeTextAttribute() {
    return trans('order.pay_type_' . OrderPayType::slug($this->pay_type));
  }

  public function getPayStatusTextAttribute() {
    return trans('order.pay_status_' . OrderPayStatus::slug($this->pay_status));
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function provider() {
    return $this->belongsTo(Provider::class,'provider_id');
  }

  public function place() {
    return $this->belongsTo(Place::class,'place_id');
  }

  public function service() {
    return $this->belongsTo(Service::class,'service_id');
  }

  public function meetingRoom() {
    return $this->belongsTo(MeetingRoom::class,'meeting_room_id');
  }

  public function statusHistory() {
    return $this->hasMany(OrderStatusHistory::class);
  }

  public function names() {
    return $this->hasMany(OrderUsersNames::class,'order_id','id');
  }

  public function dates() {
    return $this->hasMany(OrderDates::class,'order_id','id');
  }


  public static function boot() {
    parent::boot();
    self::creating(function ($model) {
      $lastId = self::max('id') ?? 0;
      $model->order_num = date('Y') . ($lastId + 1);
    });
  }

}
