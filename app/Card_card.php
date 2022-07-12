<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card_card extends Model
{
    protected $table = 'cat_cards';
    protected $fillable = [
        'card_name', 'card_discount', 'card_discount_buy','card_code','card_logo','card_type','card_status','ckcham','ckcham_status'
    ];

}
