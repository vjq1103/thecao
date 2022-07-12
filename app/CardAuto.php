<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardAuto extends Model
{
    protected $table = 'card_auto';
    protected $fillable = [
        'pin',
        'serial',
        'status',
        'price',
        'user_id',
        'card_code'
    ];
}
