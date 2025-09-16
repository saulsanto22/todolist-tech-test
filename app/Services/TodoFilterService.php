<?php

namespace App\Services;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Builder;

class TodoFilterService
{
    public function apply(array $filters): Builder
    {
        $q = Todo::query();

        if (!empty($filters['title'])) {
            $q->where('title', 'like', '%'.trim($filters['title']).'%');
        }

        if (!empty($filters['assignee'])) {
            $assignees = array_map('trim', explode(',', $filters['assignee']));
            $q->whereIn('assignee', $assignees);
        }

        if (!empty($filters['start']) || !empty($filters['end'])) {
            $start = $filters['start'] ?? null;
            $end = $filters['end'] ?? null;
            if ($start && $end) $q->whereBetween('due_date', [$start, $end]);
            elseif ($start) $q->where('due_date','>=',$start);
            elseif ($end) $q->where('due_date','<=',$end);
        }

        if (isset($filters['min']) || isset($filters['max'])) {
            $min = $filters['min'] ?? null; $max = $filters['max'] ?? null;
            if (!is_null($min) && !is_null($max)) $q->whereBetween('time_tracked', [$min, $max]);
            elseif (!is_null($min)) $q->where('time_tracked','>=',$min);
            elseif (!is_null($max)) $q->where('time_tracked','<=',$max);
        }

        if (!empty($filters['status'])) {
            $statuses = array_map('trim', explode(',', $filters['status']));
            $q->whereIn('status', $statuses);
        }

        if (!empty($filters['priority'])) {
            $priorities = array_map('trim', explode(',', $filters['priority']));
            $q->whereIn('priority', $priorities);
        }

        return $q;
    }
}
