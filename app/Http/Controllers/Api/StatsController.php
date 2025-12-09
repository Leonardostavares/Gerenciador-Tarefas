<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

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
        return response()->json($stats);
    }
}