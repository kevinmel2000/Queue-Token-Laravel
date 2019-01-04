<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StatisticalReportRepository;
use App\Models\User;
use App\Models\Department;
use App\Models\Counter;

class StatisticalReportController extends Controller
{
    protected $statistical_reports;

    public function __construct(StatisticalReportRepository $statistical_reports)
    {
        $this->statistical_reports = $statistical_reports;
    }

    public function index(Request $request)
    {
        $this->authorize('access', User::class);

        return view('user.reports.statistical.index', [
            'departments' => $this->statistical_reports->getDepartments(),
            'users' => $this->statistical_reports->getUsers(),
            'counters' => $this->statistical_reports->getCounters(),
        ]);
    }


    public function show(Request $request, $date, $user, $department, $counter)
    {
        $this->authorize('access', User::class);

        if($user!='all') $user = User::findOrFail($user);
        if($department!='all') $department = Department::findOrFail($department);
        if($counter!='all') $counter = Counter::findOrFail($counter);

        return view('user.reports.statistical.show', [
            'reports' => $this->statistical_reports->getAvgWaitingTime($date, $user, $department, $counter),
            'departments'=> $this->statistical_reports->getDepartments(),
            'users'=> $this->statistical_reports->getUsers(),
            'counters'=> $this->statistical_reports->getCounters(),
            'date' => $date,
            'suser' => $user,
            'sdepartment' => $department,
            'scounter' => $counter,
        ]);
    }
}
