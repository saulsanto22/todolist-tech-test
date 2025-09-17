<?php

namespace App\Services;
use App\Models\Todo;

class ChartService
{
    public function getChartData(string $type): array
    {
        return match ($type) {
            'status' => $this->statusSummary(),
            'priority' => $this->prioritySummary(),
            'assignee' => $this->assigneeSummary(),
            default => throw new \InvalidArgumentException('Invalid type parameter'),
        };
    }

    private function statusSummary(): array {
        $c = Todo::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total','status')->toArray();
        return ['status_summary' => [
            'pending' => $c['pending'] ?? 0,
            'open' => $c['open'] ?? 0,
            'in_progress' => $c['in_progress'] ?? 0,
            'completed' => $c['completed'] ?? 0,
        ]];
    }

    private function prioritySummary(): array {
        $c = Todo::selectRaw('priority, count(*) as total')->groupBy('priority')->pluck('total','priority')->toArray();
        return ['priority_summary' => [
            'low' => $c['low'] ?? 0,
            'medium' => $c['medium'] ?? 0,
            'high' => $c['high'] ?? 0,
        ]];
    }

    private function assigneeSummary(): array {
         $rows = Todo::selectRaw("
            assignee, 
            COUNT(*) as total_todos, 
            SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as total_pending_todos, 
            SUM(CASE WHEN status = 'completed' THEN time_tracked ELSE 0 END) as total_timetracked_completed_todos
        ")
        ->groupBy('assignee')
        ->get();

        $out = [];
        foreach ($rows as $r) {
            $key = $r->assignee ?? 'Unassigned';
            $out[$key] = [
                'total_todos' => (int)$r->total_todos,
                'total_pending_todos' => (int)$r->total_pending_todos,
                'total_timetracked_completed_todos' => (int)$r->total_timetracked_completed_todos,
            ];
        }
        return ['assignee_summary'=>$out];
    }
}
