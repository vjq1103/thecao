<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithDraw extends Model
{
    protected $table = 'withdraws';
    protected $fillable = [
        'widthraw_id','user_id','bank_id','bank_name','bank_branch','bank_account_id','bank_account_name',
        'bank_account_number','amount','amount_before','amount_after','fees','withdraw_status'
    ];
}
