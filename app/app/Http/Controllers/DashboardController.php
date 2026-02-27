<?php

namespace App\Http\Controllers;

use App\Services\PythonEngineService;

class DashboardController extends Controller
{
    public function scanTrends(PythonEngineService $engine)
    {
        // Gọi task "tasks.collect_trends" bên Python
        // Truyền params là các subreddit muốn cào
        $taskId = $engine->dispatchToPython('tasks.collect_trends',  [
             ['ArtificialInteligence', 'technology', 'programming']
        ]);

        return redirect()->back()->with('status', "Đã kích hoạt quét xu hướng! Task ID: $taskId");
    }
}