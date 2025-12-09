<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class StatsController extends Controller
{
    public function getStats()
    {
        // Exemplo com dados estruturados para o gráfico de pizza
        // Em um cenário real, você buscaria Task::count() aqui
        $stats = [
            'total_users' => 150,
            'active_users' => 120,
            'total_tasks' => 450,
            'completed_tasks' => 300,
            'pending_tasks' => 150, // Adicionado para fechar a conta da pizza
        ];

        return response()->json($stats);
    }
}