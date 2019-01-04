<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MissedOvertimeReportRepository;
use App\Models\User;
use App\Models\Counter;

class MissedOvertimeReportController extends Controller
{
    protected $missed_overtime_reports;

    public function __construct(MissedOvertimeReportRepository $missed_overtime_reports)
    {
        $this->missed_overtime_reports = $missed_overtime_reports;
    }

    public function index(Request $request)
    {
        $this->authorize('access', User::class);

        return view('user.reports.missed_overtime.index', [
            'counters' => $this->missed_overtime_reports->getCounters(),
            'users' => $this->missed_overtime_reports->getUsers(),
            'settings' => $this->missed_overtime_reports->getSettings(),
        ]);
    }

    public function show(Request $request, $date, $user, $counter, $type)
    {
        $this->authorize('access', User::class);

        if($user!='all') $user = User::findOrFail($user);
        if($counter!='all') $counter = Counter::findOrFail($counter);

        switch ($type) {
            case 'all':
                $calls = $this->missed_overtime_reports->getAllTypesDetails($date, $user, $counter);
                break;
            case 'missed':
                $calls = $this->missed_overtime_reports->getMissedDetails($date, $user, $counter);
                break;
            case 'overtime':
                $calls = $this->missed_overtime_reports->getOvertimeDetails($date, $user, $counter);
                break;
            default:
                abort(404);
                break;
        }

        return view('user.reports.missed_overtime.show', [
            'calls' => $calls,
            'counters'=> $this->missed_overtime_reports->getCounters(),
            'users'=> $this->missed_overtime_reports->getUsers(),
            'date' => $date,
            'scounter' => $counter,
            'suser' => $user,
            'type' => $type,
        ]);
    }
}
