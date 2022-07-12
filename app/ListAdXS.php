<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListAdXS extends Model
{
    protected $table = 'admin_xs';
    protected $fillable = [
        'id',
        'name',
		'phone',
		'email',
		'ip',
		'note',
		'time',
    ];
}
