<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Setting;
use App\Models\Queue;
use App\Models\Call;
use App\Models\Counter;
use Carbon\Carbon;

class DashbordRepository
{
    public function getSetting()
    {
        return Setting::first();
    }

    public function getTodayQueue()
    {
        return Queue::whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->count();

    }

    public function getTodayServed()
    {
        return Call::whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->count();
    }

    public function getCounters()
    {
        return Counter::all();
    }

    public function getTodayMissed()
    {
        $setting = $this->getSetting();

        $calls = Call::whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->get();

        $count = 0;
        foreach ($calls as $call) {
            $next_call_key = $calls->search(function($incall, $key) use($call) {
                if(($incall->id>$call->id) && ($incall->counter_id==$call->counter_id)) return $key;
            });

            if($next_call_key && ($calls[$next_call_key]->created_at->timestamp-$call->created_at->timestamp)<$setting->missed_time) $count++;
        }
        return $count;
    }

    public function getTodayOverTime()
    {
        $setting = $this->getSetting();

        $calls = Call::whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->get();

        $count = 0;
        foreach ($calls as $call) {
            $next_call_key = $calls->search(function($incall, $key) use($call) {
                if(($incall->id>$call->id) && ($incall->counter_id==$call->counter_id)) return $incall;
            });

            if($next_call_key && ($calls[$next_call_key]->created_at->timestamp-$call->created_at->timestamp)>$setting->over_time) $count++;
        }
        return $count;
    }

    public function getTodayCalls()
    {
        $counters = $this->getCounters();

        $count = [];
        foreach ($counters as $counter) {
            $count[] = $counter->calls()
                    ->whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->count();
        }

        return $count;
    }

    public function getYesterdayCalls()
    {
        $counters = $this->getCounters();

        $count = [];
        foreach ($counters as $counter) {
            $count[] = $counter->calls()
                    ->whereBetween('created_at', [Carbon::yesterday()->format('Y-m-d').' 00:00:00', Carbon::yesterday()->format('Y-m-d').' 23:59:59'])
                    ->count();
        }

        return $count;
    }

    public function updateNotification($data)
    {
        $setting = $this->getSetting();

        $setting->notification = $data['notification'];
        $setting->size = $data['size'];
        $setting->color = $data['color'];
        $setting->save();

        return $setting;
    }
}
