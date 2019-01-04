<?php

namespace App\Repositories;

use App\Models\Queue;
use Carbon\Carbon;

class QueueListReportRepository
{
    public function getQueueListReport($date)
    {
        try {
            $date = Carbon::createFromFormat('d-m-Y', $date);
        } catch(\Exception $e) {
            abort(404);
        }

        return Queue::with('department', 'call', 'call.user', 'call.counter')
                    ->whereBetween('queues.created_at', [$date->format('Y-m-d 00:00:00'), $date->format('Y-m-d 23:59:59')])
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}
