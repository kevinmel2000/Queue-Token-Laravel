<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CallRepository;
use App\Models\User;
use App\Models\Department;
use App\Models\Counter;
use App\Models\Call;
use Carbon\Carbon;

class CallController extends Controller
{
    protected $calls;

    public function __construct(CallRepository $calls)
    {
        $this->calls = $calls;
    }

    public function index(Request $request)
    {
        event(new \App\Events\TokenIssued());

        return view('user.calls.index', [
            'users' => $this->calls->getUsers(),
            'counters' => $this->calls->getCounters(),
            'departments' => $this->calls->getDepartments(),
        ]);
    }

    public function newCall(Request $request)
    {
        $this->validate($request, [
            'user' => 'bail|required|exists:users,id',
            'counter' => 'bail|required|exists:counters,id',
            'department' => 'bail|required|exists:departments,id',
        ]);

        $user = User::findOrFail($request->user);
        $counter = Counter::findOrFail($request->counter);
        $department = Department::findOrFail($request->department);

        $queue = $this->calls->getNextToken($department);

        if($queue==null) {
            flash()->warning('No Token for this department');
            return redirect()->route('calls');
        }

        $call = $queue->call()->create([
            'department_id' => $department->id,
            'counter_id' => $counter->id,
            'user_id' => $user->id,
            'number' => $queue->number,
            'called_date' => Carbon::now()->format('Y-m-d'),
        ]);

        $queue->called = 1;
        $queue->save();

        $request->session()->flash('department', $department->id);
        $request->session()->flash('counter', $counter->id);

        event(new \App\Events\TokenIssued());
        event(new \App\Events\TokenCalled());

        flash()->success('Token Called');
        return redirect()->route('calls');
    }

    public function postDept(Request $request, Department $department)
    {
        $last_token = $this->calls->getLastToken($department);

        if($last_token) {
            $queue = $department->queues()->create([
                'number' => ((int)$last_token->number)+1,
                'called' => 0,
            ]);
        } else {
            $queue = $department->queues()->create([
                'number' => $department->start,
                'called' => 0,
            ]);
        }

        $total = $this->calls->getCustomersWaiting($department);

        event(new \App\Events\TokenIssued());

        $request->session()->flash('department_name', $department->name);
        $request->session()->flash('number', ($department->letter!='')?$department->letter.'-'.$queue->number:$queue->number);
        $request->session()->flash('total', $total);

        flash()->success('Token Added');
        return redirect()->route('calls');
    }

    public function recall(Request $request)
    {
        $call = Call::find($request->call_id);
        $new_call = $call->replicate();
        $new_call->save();

        $call->delete();

        event(new \App\Events\TokenCalled());

        flash()->success('Token Called');
        return $new_call->toJson();
    }
}
