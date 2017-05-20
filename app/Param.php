<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Param extends Model
{
    protected $table = 'tank_params';
    protected $fillable = ['name'];

    public $timestamps = false;
}
