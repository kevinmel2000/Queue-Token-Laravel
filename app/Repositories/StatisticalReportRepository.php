<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Department;
use App\Models\Counter;
use App\Models\Call;
use Carbon\Carbon;

class StatisticalReportRepository
{
    public function getDepartments()
    {
        return Department::all();
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getCounters()
    {
        return Counter::all();
    }

    public function getAvgWaitingTime($date, $user, $department, $counter)
    {
        try {
            $date = Carbon::createFromFormat('d-m-Y', $date);
        } catch(\Exception $e) {
            abort(404);
        }

        $need = [];
        for($i=01;$i<=$date->daysInMonth;$i++) {
            $q = Call::with('queue', 'department', 'counter', 'user')
                    ->whereDay('created_at','=', $i)
                    ->whereMonth('created_at','=', $date->format('m'))
                    ->whereYear('created_at','=', $date->format('Y'));

                if($user!='all') $q->where('user_id', $user->id);
                if($department!='all') $q->where('department_id', $department->id);
                if($counter!='all') $q->where('counter_id', $counter->id);

            $calls = $q->get();

            if($calls->count()) {
                $t = 0;
                foreach ($calls as $key => $call) {
                    $t2 = $call->created_at->timestamp-$call->queue->created_at->timestamp;
                    $t += $t2;
                    $calls[$key]->time = $t2;
                }

                $need[$i]['avg'] = round(($t/$calls->count())/60, 2);
                $need[$i]['min'] = round($calls->min('time')/60, 2);
                $need[$i]['max'] = round($calls->max('time')/60, 2);
                $need[$i]['count'] = $calls->count();
            } else {
                $need[$i]['avg'] = 0;
                $need[$i]['min'] = 0;
                $need[$i]['max'] = 0;
                $need[$i]['count'] = 0;
            }
        }

        return $need;
    }
}
