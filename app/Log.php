<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = [
       'log_id','log_user_id', 'log_receiver', 'log_content','log_amount','log_time','log_type','log_read',
       'card_price'
    ];
}
