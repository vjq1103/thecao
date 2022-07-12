<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermUser extends Model
{
    protected $table = 'term_user';
    protected $fillable = [
        'id',
        'phone',
        'price_term',
        'price',
        'note',
        'money',
        'link_id',
        'money_error',
        'status_card_error',
        'getagent',
        'getlanguage',
        'getlink',
    ];
}
