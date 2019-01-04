<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'role', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function calls()
	{
		return $this->hasMany('App\Models\Call');
	}

	public function getRoleTextAttribute($value)
	{
		if($this->attributes['role']=='A') return trans('messages.mainapp.role.Administrator');

		return trans('messages.mainapp.role.Staff');
	}

    public function getIsAdminAttribute($value)
	{
		if($this->attributes['role']=='A') return true;

        return false;
	}
}
