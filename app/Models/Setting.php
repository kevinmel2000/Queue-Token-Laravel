<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['language_id', 'name', 'bus_no', 'address', 'email', 'phone', 'location', 'notification', 'size', 'color', 'logo', 'over_time', 'missed_time'];

    public function language()
	{
		return $this->belongsTo('App\Models\Language');
	}
}
