<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListLogPayment extends Model
{
    protected $table = 'logs_payment';
    protected $fillable = [
        'id',
        'title',
		'content',
		'created_at',
		'updated_at',
    ];
}
