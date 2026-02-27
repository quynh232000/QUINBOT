<?php

namespace App\Http\Controllers;

use App\Models\Trend;
use App\Models\VideoProject;
use App\Services\PythonEngineService;
use Illuminate\Support\Facades\DB;

class TrendController extends Controller
{
    private $TASK_GENERATE_SCRIPT = 'tasks.generate_script';
    public function index()
    {
        // Hiển thị danh sách xu hướng đã lưu
        $trends = Trend::orderBy('created_at', 'desc')->paginate(30);
        return view('trend.index', compact('trends'));
    }
    public function approve(PythonEngineService $engine, $id)
    {
        try {
            DB::beginTransaction();
            $trend = Trend::findOrFail($id);
            if ($trend->status === 'approved') {
                return back()->with('error', 'Bài viết này đã được duyệt trước đó.');
            }
            $trend->update(['status' => 'approved']);

            // Tạo một Project Video mới để theo dõi tiến độ
            $project = VideoProject::create([
                'trend_id' => $trend->id,
                'project_name' => $trend->title,
                'status' => 'processing',
                'current_step' => 'scripting'
            ]);

            // Gửi Task sang Python Engine qua Celery
            // Lưu ý: Tên task phải khớp với @shared_task bên Python
            $engine->dispatchToPython($this->TASK_GENERATE_SCRIPT,[], [
                'project_id' => $project->id,
                'trend_id' => $trend->id
            ]);
            DB::commit();
            return back()->with('status', 'Đã duyệt bài viết và gửi yêu cầu tạo kịch bản video!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
        
    }
}
