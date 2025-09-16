<?php

namespace App\Services;
use App\Models\Todo;

class TodoService
{
    public function create(array $data): Todo {
        $data['status'] = $data['status'] ?? 'pending';
        $data['time_tracked'] = $data['time_tracked'] ?? 0;
        return Todo::create($data);
    }
}
