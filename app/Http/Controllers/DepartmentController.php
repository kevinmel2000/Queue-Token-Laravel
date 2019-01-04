<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DepartmentRepository;
use App\Models\Department;

class DepartmentController extends Controller
{
    protected $departments;

    public function __construct(DepartmentRepository $departments)
    {
        $this->departments = $departments;
    }

    public function index()
    {
        $this->authorize('access', Department::class);

        return view('user.departments.index', [
            'departments' =>$this->departments->getAll(),
        ]);
    }

    public function create()
    {
        $this->authorize('access', Department::class);

        return view('user.departments.create');
    }

    public function store(Request $request)
    {
        $this->authorize('access', Department::class);

        $this->validate($request, [
            'name' => 'required',
            'start' =>'required|numeric'
        ]);

        Department::create($request->all());

        flash()->success('Department created');
        return redirect()->route('departments.index');
    }

    public function edit(Request $request, Department $department)
    {
        $this->authorize('access', Department::class);

        return view('user.departments.edit', [
            'department' => $department,
        ]);
    }

    public function update(Request $request, Department $department)
    {
        $this->authorize('access', Department::class);

        $this->validate($request, [
            'name' => 'required',
            'start' =>'required|numeric',
        ]);

        $department->name = $request->name;
        $department->letter = $request->letter;
        $department->start = $request->start;
        $department->save();

        flash()->success('Department updated');
        return redirect()->route('departments.index');
    }

    public function destroy(Request $request, Department $department)
    {
        $this->authorize('access', Department::class);

        $department->delete();

        flash()->success('Department deleted');
        return redirect()->route('departments.index');
    }
}
