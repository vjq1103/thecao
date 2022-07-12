<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListFrame extends Model
{
    protected $table = 'links';
    protected $fillable = [
        'id',
        'title',
		'content',
		'price',
		'user_id',
		'active',
		'created_at',
		'updated_at',
		'frame',
		'title1',
		'title2',
        'color',
        'background',
        'text',
    ];
}
