<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetingData extends Model
{

    protected $table = 'setting_data';
    protected $fillable = [
        'id','tigia', 'usdt', 'tentk','tk1','tk2','tk3','tk4','tk5', 'tk6', 'gia1','gia2', 'gia3',
        'gia4','gia5', 'gia6'
    ];


}
