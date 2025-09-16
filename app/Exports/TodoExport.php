<?php

namespace App\Exports;

use App\Models\Todo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class TodoExport implements FromView
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Todo::query();
       
   // title: partial match (case-insensitive di PostgreSQL)
if ($this->request->filled('title')) {
    $query->where('title', 'ILIKE', '%' . $this->request->title . '%');
}


        // assignee: multiple
        if ($this->request->filled('assignee')) {
            $assignees = array_map('trim', explode(',', $this->request->assignee));
            $query->whereIn('assignee', $assignees);
        }

        // due_date: range
        if ($this->request->filled('start') && $this->request->filled('end')) {
            $query->whereBetween('due_date', [$this->request->start, $this->request->end]);
        }

        // time_tracked: range
        if ($this->request->filled('min') && $this->request->filled('max')) {
            $query->whereBetween('time_tracked', [(int) $this->request->min, (int) $this->request->max]);
        }

        // status: multiple
        if ($this->request->filled('status')) {
            $statuses = array_map('trim', explode(',', $this->request->status));
            $query->whereIn('status', $statuses);
        }

        // priority: multiple
        if ($this->request->filled('priority')) {
            $priorities = array_map('trim', explode(',', $this->request->priority));
            $query->whereIn('priority', $priorities);
        }


        $todos = $query->get();

        return view('exports.excel', [
            'todos' => $todos,
            'totalTodos' => $todos->count(),
            'totalTimeTracked' => $todos->sum('time_tracked')
        ]);
    }
}
