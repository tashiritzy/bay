<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advcomment extends Model
{
    //
    protected $table ='advcomment';
    protected $fillable = ['id', 'comment', 'userid', 'created_at', 'updated_at'];
}
