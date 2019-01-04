<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MonthlyReportRepository;
use App\Models\User;
use App\Models\Department;

class MonthlyReportController extends Controller
{
    protected $monthly_reports;

    public function __construct(MonthlyReportRepository $monthly_reports)
    {
        $this->monthly_reports = $monthly_reports;
    }

    public function index(Request $request)
    {
        $this->authorize('access', User::class);

        return view('user.reports.monthly.index', [
            'departments' => $this->monthly_reports->getDepartments(),
        ]);
    }


    public function show(Request $request, $department, $sdate, $edate)
    {
        $this->authorize('access', User::class);

        if($department=='all') {
            $calls = $this->monthly_reports->getAllReport($sdate, $edate);
        } else {
            $department = Department::findOrFail($department);
            $calls = $this->monthly_reports->getDepartmentReport($sdate, $edate, $department);
        }

        return view('user.reports.monthly.show', [
            'departments' => $this->monthly_reports->getDepartments(),
            'sdepartment' => $department,
            'sdate' => $sdate,
            'edate' => $edate,
            'calls' => $calls,
        ]);
    }
}
