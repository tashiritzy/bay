<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bssr extends Model
{
    protected $table ='adv';
    protected $fillable = ['advtopic', 'description', 'price', 'phone', 'email', 'placeid', 'categoryid', 'userid',
    'pictureid', 'status', 'created_at', 'updated_at'];
}
