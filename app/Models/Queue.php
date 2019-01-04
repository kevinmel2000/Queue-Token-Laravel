<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = ['department_id', 'number', 'called'];

    public function call()
	{
		return $this->hasOne('App\Models\Call');
	}

    public function department()
	{
		return $this->belongsTo('App\Models\Department');
	}
}
