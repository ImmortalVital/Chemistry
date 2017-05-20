<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'tank_classes';
    protected $fillable = ['name'];

    public $timestamps = false;
}
