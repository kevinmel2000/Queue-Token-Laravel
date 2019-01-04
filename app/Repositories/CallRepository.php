<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Department;
use App\Models\Counter;
use App\Models\Queue;
use Carbon\Carbon;

class CallRepository
{
    public function getUsers()
    {
        return User::all();
    }

    public function getCounters()
    {
        return Counter::all();
    }

    public function getDepartments()
    {
        return Department::all();
    }

    public function getNextToken(Department $department)
    {
        return $department->queues()
                    ->where('called', 0)
                    ->where('created_at', '>', Carbon::now()->format('Y-m-d 00:00:00'))
                    ->first();
    }

    public function getLastToken(Department $department)
    {
        return $department->queues()
                    ->where('created_at', '>', Carbon::now()->format('Y-m-d 00:00:00'))
                    ->orderBy('created_at', 'desc')
                    ->first();
    }

    public function getCustomersWaiting(Department $department)
    {
        return $department->queues()
                    ->where('called', 0)
                    ->where('created_at', '>', Carbon::now()->format('Y-m-d 00:00:00'))
                    ->count();
    }
}
