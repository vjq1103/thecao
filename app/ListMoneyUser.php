<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListMoneyUser extends Model
{
    protected $table = 'users';
    protected $fillable = [
	 'id',
	 'name', 
	 'email',
	 'password',
	 'phone_number1',
	 'ref',
	 'money_1',
	 'money_2',
	 'level',
	 'status',
	 'created_at',
	 'updated_at', 
	 'member',
	 'tam_giu',
	 'tinh',	 
	 'is_Admin',
	 'chiet_khau_frame',
    ];
}
