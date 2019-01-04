<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QueueListReportRepository;
use App\Models\User;

class QueueListReportController extends Controller
{
    protected $queue_list_report;

    public function __construct(QueueListReportRepository $queue_list_report)
    {
        $this->queue_list_report = $queue_list_report;
    }

    public function index(Request $request, $date)
    {
        $this->authorize('access', User::class);

        return view('user.reports.queue_list.index', [
            'queues' => $this->queue_list_report->getQueueListReport($date),
            'date' => $date,
        ]);
    }


}
