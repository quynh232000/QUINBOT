<?php

namespace App\Http\Controllers;

use App\Models\VideoProject;
use Illuminate\Http\Request;

class VideoProjectController extends Controller
{
    public function index()  {
        $projects = VideoProject::orderByDesc('created_at')->paginate(20);
        return view('video-project.index',compact('projects'));
    }
    public function show($id)  {
        $project = VideoProject::with('trend')->find($id);
        // dd($project->toArray());
         return view('video-project.show',compact('project'));
    }
}
