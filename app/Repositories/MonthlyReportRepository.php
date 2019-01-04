<?php

namespace App\Repositories;

use App\Models\Department;
use App\Models\Call;
use Carbon\Carbon;

class MonthlyReportRepository
{
    public function getDepartments()
    {
        return Department::all();
    }

    public function getDepartmentReport($sdate, $edate, $department)
    {
        try {
            $sdate = Carbon::createFromFormat('d-m-Y', $sdate);
            $edate = Carbon::createFromFormat('d-m-Y', $edate);
        } catch(\Exception $e) {
            abort(404);
        }

        return $department->calls()
                    ->with('queue', 'counter', 'department', 'user')
                    ->whereBetween('called_date',[$sdate->format('Y-m-d 00:00:00'), $edate->format('Y-m-d 23:59:59')])
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    public function getAllReport($sdate, $edate)
    {
        try {
            $sdate = Carbon::createFromFormat('d-m-Y', $sdate);
            $edate = Carbon::createFromFormat('d-m-Y', $edate);
        } catch(\Exception $e) {
            abort(404);
        }

        return Call::with('queue', 'counter', 'department', 'user')
                    ->whereBetween('called_date',[$sdate->format('Y-m-d 00:00:00'), $edate->format('Y-m-d 23:59:59')])
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

}
