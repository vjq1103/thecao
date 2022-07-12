<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListTempUser extends Model
{
    protected $table = 'term_user';
    protected $fillable = [
        'id',
        'phone',
		'price_term',
		'price',
		'note',
		'created_at',
		'updated_at',
		'money',
		'link_id',
		'money_error',
        'status_card_error',
    ];
}
