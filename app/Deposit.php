<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Deposit;
use App\Log;
use Config;

class Deposit extends Model
{
    protected $table = 'deposits';
    protected $fillable = [
        'deposit_id', 'user_id', 'user_name','deposit_amount','deposit_memo','deposit_notes','user_last_confirm','deposit_status'
    ];
}
