<?php

namespace App\Listeners;

use App\Events\TokenIssued;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Queue;
use Carbon\Carbon;

class UpdateCallTable
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(TokenIssued $event)
    {
        $queues = Queue::with('department')
                    ->whereBetween('queues.created_at',[Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')])
                    ->orderBy('queues.created_at', 'desc')
                    ->get();

        $queue_array = [];
        foreach ($queues as $key => $queue) {
            if($queue->called) {
                $queue_array[$key]['id'] = ((int)$key)+1;
                $queue_array[$key]['department'] = $queue->department->name;
                $queue_array[$key]['number'] = ($queue->department->letter!='')?$queue->department->letter.'-'.$queue->number:$queue->number;
                $queue_array[$key]['called'] = 'Yes';
                $queue_array[$key]['counter'] = $queue->call->counter->name;
                $queue_array[$key]['recall'] = '<button class="btn-floating waves-effect waves-light tooltipped" onclick="recall('.$queue->call->id.')"><i class="mdi-navigation-refresh"></i></button>';
            } else {
                $queue_array[$key]['id'] = ((int)$key)+1;
                $queue_array[$key]['department'] = $queue->department->name;
                $queue_array[$key]['number'] = ($queue->department->letter!='')?$queue->department->letter.'-'.$queue->number:$queue->number;
                $queue_array[$key]['called'] = 'No';
                $queue_array[$key]['counter'] = 'NIL';
                $queue_array[$key]['recall'] = '<button class="btn-floating disabled" disabled><i class="mdi-navigation-refresh"></i></button>';
            }
        }

        $data = array('data' => $queue_array);

        file_put_contents(base_path('assets/files/call'), json_encode($data));
    }
}
