<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tinh extends Model
{
    protected $table = 'tinh';
    protected $fillable = [
       'matp','name','type'
    ];
}
