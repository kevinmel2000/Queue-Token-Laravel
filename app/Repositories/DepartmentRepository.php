<?php

namespace App\Repositories;

use App\Models\Department;

class DepartmentRepository
{
    public function getAll()
    {
        return Department::all();
    }
}
