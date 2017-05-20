<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassParam extends Model
{
    protected $table = 'tank_class_params';
    protected $fillable = ['class_id', 'param_id', 'value_id'];

    public $timestamps = false;

    public function _class()
    {
        return $this->hasOne('App\ClassModel', 'id', 'class_id');
    }

    public function param()
    {
        return $this->hasOne('App\Param', 'id', 'param_id');
    }

    public function value()
    {
        return $this->hasOne('App\Value', 'id', 'value_id');
    }
}
