<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
	protected $table ='picture';
	
	protected $fillable = ['id', 'path', 'advid', 'created_at', 'updated_at'];
}
