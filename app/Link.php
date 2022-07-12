<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';
    protected $fillable = [
        'id',
        'title',
        'content',
        'price',
        'user_id',
        'active',
        'frame',
        'title1',
        'title2',
        'color',
        'background',
        'text',
    ];
}
