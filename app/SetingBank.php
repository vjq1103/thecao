<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetingBank extends Model
{

    protected $table = 'setting_bank';
    protected $fillable = [
        'id','tigia', 'name', 'number','img'
    ];


}
