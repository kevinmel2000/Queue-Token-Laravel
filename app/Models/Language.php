<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['code', 'name', 'display', 'image'];

    public function settings()
	{
		return $this->hasMany('App\Models\Setting');
	}
}
