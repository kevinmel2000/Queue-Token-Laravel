<?php

namespace App\Repositories;

use App\Models\Counter;

class CounterRepository
{
    public function getAll()
    {
        return Counter::all();
    }
}
