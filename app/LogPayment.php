<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogPayment extends Model
{
    protected $table = 'logs_payment';
    protected $fillable = [
        'title',
        'content'
    ];
}
