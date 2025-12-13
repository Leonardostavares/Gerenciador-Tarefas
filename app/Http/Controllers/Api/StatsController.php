<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request;

class StatsController extends Controller
{
    public function tasks() {
        $userId = auth::id();
        $stats = DB::select("select 
                                    categories.name as label,
                                    COUNT(tasks.id) as total
                                    from tasks
                                    join categories on tasks.category_id = categories.id
                                    where tasks.user_id = ?
                                    GROUP BY categories.name", [$userId]);
                                    
        $labels = array_column($stats, 'label');

        $values = array_column($stats, 'total');

        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }
     public function averageTasks() {
        $userId = auth::id();
        $stats = DB::select('SELECT categories.name AS label, 
               ROUND(AVG(DATEDIFF(tasks.finished_at, tasks.created_at)), 1) AS value
        FROM tasks
        INNER JOIN categories ON tasks.category_id = categories.id
        WHERE tasks.user_id = ? AND tasks.finished_at IS NOT NULL
        GROUP BY categories.name
        ORDER BY value DESC', [$userId]);

        $labels = array_column($stats, 'label');
        $values = array_column($stats, 'value');

        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }

    public function statusTasks() {
        $userId = auth::id();
        $stats = DB::select('SELECT 
                                    tasks.status AS label,
                                    COUNT(tasks.id) AS total
                            FROM tasks
                            WHERE tasks.user_id = ?
                            GROUP BY tasks.status
                            ORDER BY tasks.status ASC', [$userId]);

        $labels = array_column($stats, 'label');
        $values = array_column($stats, 'total');

        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }
}