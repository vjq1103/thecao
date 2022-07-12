<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
       'payment_id','phone','card_type_id', 'pin', 'serial','provider','user_id','link_id','ip_request',
       'price','amount','rate','transaction_id','balance','balance_before','requestId','topup_type','is_image','image_url',
       'notes','created_at','updated_at','payment_status','is_deleted','getlink','getagent','getlanguage','nguoiduyet','kieunap',
    ];
}
