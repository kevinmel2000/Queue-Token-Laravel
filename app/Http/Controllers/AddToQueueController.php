<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AddToQueueRepository;
use App\Models\Setting;
use App\Models\Department;

class AddToQueueController extends Controller
{
    protected $add_to_queues;

    public function __construct(AddToQueueRepository $add_to_queues)
    {
        $this->add_to_queues = $add_to_queues;
    }

    public function index(Request $request)
    {
        $settings = Setting::first();

        \App::setLocale($settings->language->code);

        return view('addtoqueue.index', [
            'settings' => $settings,
            'departments' => $this->add_to_queues->getDepartments(),
        ]);
    }

    public function postDept(Request $request)
    {
        $department = Department::findOrFail($request->department);

        $last_token = $this->add_to_queues->getLastToken($department);

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

        $total = $this->add_to_queues->getCustomersWaiting($department);

        event(new \App\Events\TokenIssued());

        $request->session()->flash('department_name', $department->name);
        $request->session()->flash('number', ($department->letter!='')?$department->letter.'-'.$queue->number:$queue->number);
        $request->session()->flash('total', $total);

        flash()->success('Token Added');
        return redirect()->route('add_to_queue');
    }
}
