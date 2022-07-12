<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListUser extends Model
{
    protected $table = 'list_member';
    protected $fillable = [
        'id',
        'name',
        'phone',
        'email',
        'browser',
        'ip',
        'location',
        'money',
        'note',
		"created_at",
		"updated_at",		
		"getlink",	
		"getagent",	
		"getlanguage",
		
		
    ];
}
