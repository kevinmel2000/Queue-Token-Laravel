<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserReportRepository;
use App\Models\User;

class UserReportController extends Controller
{
  protected $user_reports;

    public function __construct(UserReportRepository $user_reports)
    {
        $this->user_reports = $user_reports;
    }

    public function index(Request $request)
    {
        $this->authorize('access', User::class);

        return view('user.reports.user.index', [
            'users' => $this->user_reports->getUsers(),
        ]);
    }

    public function show(Request $request, User $user, $date)
    {
        $this->authorize('access', User::class);

        return view('user.reports.user.show', [
            'calls' => $this->user_reports->getUserReport($user, $date),
            'suser' => $user,
            'date' => $date,
            'users' => $this->user_reports->getUsers(),
        ]);
    }
}
