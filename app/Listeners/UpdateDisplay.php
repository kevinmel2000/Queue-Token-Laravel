<?php

namespace App\Listeners;

use App\Events\TokenCalled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Call;
use Carbon\Carbon;

class UpdateDisplay
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

    public function handle(TokenCalled $event)
    {
        $calls = Call::with('department', 'counter')
                    ->where('called_date', Carbon::now()->format('Y-m-d'))
                    ->orderBy('calls.id', 'desc')
                    ->take(4)
                    ->get();

        $data = [];
        for ($i=0;$i<4;$i++) {
            $data[$i]['call_id'] = (isset($calls[$i]))?$calls[$i]->id:'NIL';
            $data[$i]['number'] = (isset($calls[$i]))?(($calls[$i]->department->letter!='')?$calls[$i]->department->letter.'-'.$calls[$i]->number:$calls[$i]->number):'NIL';
            $data[$i]['call_number'] = (isset($calls[$i]))?(($calls[$i]->department->letter!='')?$calls[$i]->department->letter.' '.$calls[$i]->number:$calls[$i]->number):'NIL';
            $data[$i]['counter'] = (isset($calls[$i]))?$calls[$i]->counter->name:'NIL';
        }

        file_put_contents(base_path('assets/files/display'), json_encode($data));
    }
}
