<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_account';
    protected $fillable = [
        'user_id','bank_id','province_id','bank_branch','account_name','account_number','status'
    ];
}
