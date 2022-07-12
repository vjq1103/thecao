<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';
    protected $fillable = [
       'card_id','order_id', 'card_pin', 'card_serial','card_notes','card_provider','created_at','updated_at',
       'card_price'
    ];
}
