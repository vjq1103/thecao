<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListLog extends Model
{
    protected $table = 'logs';
    protected $fillable = [
        'id',
        'log_user_id',
		'log_receiver',
		'log_content',
		'log_amount',
		'log_time',
		'log_type',
		'log_read',		
		'created_at',
		'updated_at',
    ];
}
