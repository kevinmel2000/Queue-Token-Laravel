<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = ['name'];

    public function calls()
	{
		return $this->hasMany('App\Models\Call');
	}
}
