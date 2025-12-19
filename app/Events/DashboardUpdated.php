<?php

namespace App\Events;
use Illuminate\Support\Facades\DB;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DashboardUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $tasksByCategory;
    public $averageTime;
    public $tasksByStatus;

    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->tasksByCategory = $this->buscarTasksByCategory();
        $this->averageTime = $this->buscarAverageTime();
        $this->tasksByStatus = $this->buscarTasksByStatus();
    }

    public function buscarTasksByCategory() {
        $stats = DB::select("select 
                                    categories.name as label,
                                    COUNT(tasks.id) as total
                                    from tasks
                                    join categories on tasks.category_id = categories.id
                                    where tasks.user_id = ?
                                    GROUP BY categories.name", [$this->userId]);
                                    
        return [
            'labels' => array_column($stats, 'label'),
            'values' => array_column($stats, 'total')
        ];
    }
    public function buscarAverageTime() {
        $stats = DB::select('SELECT categories.name AS label, 
               ROUND(AVG(DATEDIFF(tasks.finished_at, tasks.created_at)), 1) AS value
        FROM tasks
        INNER JOIN categories ON tasks.category_id = categories.id
        WHERE tasks.user_id = ? AND tasks.finished_at IS NOT NULL
        GROUP BY categories.name
        ORDER BY value DESC', [$this->userId]);

        return [
            'labels' => array_column($stats, 'label'),
            'values' => array_column($stats, 'value')
        ];
    }

    public function buscarTasksByStatus() {
        $stats = DB::select('SELECT 
                                    tasks.status AS label,
                                    COUNT(tasks.id) AS total
                            FROM tasks
                            WHERE tasks.user_id = ?
                            GROUP BY tasks.status
                            ORDER BY tasks.status ASC', [$this->userId]);

        return [
            'labels' => array_column($stats, 'label'),
            'values' => array_column($stats, 'total')
        ];
    }
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.'.$this->userId),
        ];
    }
}
