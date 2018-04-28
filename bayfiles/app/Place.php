<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    //
    protected $table ='place';
    protected $fillable = ['id', 'placename', 'created_at', 'updated_at'];
}
