<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;

class UserReportRepository
{
    public function getUsers()
    {
        return User::orderBy('name', 'asc')
                    ->get();
    }

    public function getUserReport(User $user, $date)
    {
        try {
            $date = Carbon::createFromFormat('d-m-Y', $date);
        } catch(\Exception $e) {
            abort(404);
        }

       return $user->calls()
                    ->with('department', 'counter')
                    ->where('called_date', $date->format('Y-m-d'))
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}
