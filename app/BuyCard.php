<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyCard extends Model
{
    protected $table = 'buy_cards';
    protected $fillable = [
'user_id',
'card_provider_code',
'card_provider_name',
'card_discount',
'card_amount',
'card_amount_discount',
'card_qty',
'card_prices',
'card_prices_discounted',
'money_before',
'money_after',
'card_notes',
'card_info',
'card_pin',
'card_serial',
'status',
'is_deleted'
    ];
}
