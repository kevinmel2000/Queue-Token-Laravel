<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $fillable = ['queue_id', 'department_id', 'counter_id', 'user_id', 'number', 'called_date'];

    public function queue()
	{
		return $this->belongsTo('App\Models\Queue');
	}

    public function department()
	{
		return $this->belongsTo('App\Models\Department');
	}

    public function counter()
	{
		return $this->belongsTo('App\Models\Counter');
	}

    public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
}
