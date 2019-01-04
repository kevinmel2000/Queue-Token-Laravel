<?php

namespace App\Repositories;

use App\Models\Counter;
use App\Models\User;
use App\Models\Setting;
use App\Models\Call;
use Carbon\Carbon;

class MissedOvertimeReportRepository
{
    public function getCounters()
    {
        return Counter::all();
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getSettings()
    {
        return Setting::first();
    }

    public function getAllTypesDetails($date, $user, $counter)
    {
        try {
            $date = Carbon::createFromFormat('d-m-Y', $date);
        } catch(\Exception $e) {
            abort(404);
        }

        $q = Call::with('queue', 'user', 'department', 'counter')
                    ->where('called_date', $date->format('Y-m-d'));

        if($user!='all') $q->where('user_id', $user->id);
        if($counter!='all') $q->where('counter_id', $counter->id);

        $calls = $q->get();

        foreach ($calls as $key => $call) {
            $next_call_key = $calls->search(function($incall, $key) use($call) {
                if(($incall->id>$call->id) && ($incall->counter_id==$call->counter_id)) return $key;
            });

            if($next_call_key) {
                $call->serving_end = $calls[$next_call_key]->created_at;
                $call->served_time = round((($calls[$next_call_key]->created_at->timestamp-$call->created_at->timestamp)/60), 2);
            } else {
                $calls->pull($key);
            }
        }

        return $calls;
    }

    public function getMissedDetails($date, $user, $counter)
    {
        try {
            $date = Carbon::createFromFormat('d-m-Y', $date);
        } catch(\Exception $e) {
            abort(404);
        }

        $settings = $this->getSettings();

        $q = Call::with('queue', 'user', 'department', 'counter')
                    ->where('called_date', $date->format('Y-m-d'));

        if($user!='all') $q->where('user_id', $user->id);
        if($counter!='all') $q->where('counter_id', $counter->id);

        $calls = $q->get();

        foreach ($calls as $key => $call) {
            $next_call_key = $calls->search(function($incall, $key) use($call) {
                if(($incall->id>$call->id) && ($incall->counter_id==$call->counter_id)) return $key;
            });

            if($next_call_key) {
                if(($calls[$next_call_key]->created_at->timestamp-$call->created_at->timestamp)<$settings->missed_time) {
                    $call->serving_end = $calls[$next_call_key]->created_at;
                    $call->served_time = round((($calls[$next_call_key]->created_at->timestamp-$call->created_at->timestamp)/60), 2);
                } else {
                    $calls->pull($key);
                }
            } else {
                $calls->pull($key);
            }
        }

        return $calls;
    }

    public function getOvertimeDetails($date, $user, $counter)
    {
        try {
            $date = Carbon::createFromFormat('d-m-Y', $date);
        } catch(\Exception $e) {
            abort(404);
        }

        $settings = $this->getSettings();

        $q = Call::with('queue', 'user', 'department', 'counter')
                    ->where('called_date', $date->format('Y-m-d'));

        if($user!='all') $q->where('user_id', $user->id);
        if($counter!='all') $q->where('counter_id', $counter->id);

        $calls = $q->get();

        foreach ($calls as $key => $call) {
            $next_call_key = $calls->search(function($incall, $key) use($call) {
                if(($incall->id>$call->id) && ($incall->counter_id==$call->counter_id)) return $key;
            });

            if($next_call_key) {
                if(($calls[$next_call_key]->created_at->timestamp-$call->created_at->timestamp)>$settings->over_time) {
                    $call->serving_end = $calls[$next_call_key]->created_at;
                    $call->served_time = round((($calls[$next_call_key]->created_at->timestamp-$call->created_at->timestamp)/60), 2);
                } else {
                    $calls->pull($key);
                }
            } else {
                $calls->pull($key);
            }
        }

        return $calls;
    }
}
