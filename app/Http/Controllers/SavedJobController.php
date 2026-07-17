<?php
namespace App\Http\Controllers;

use App\Models\JobCircular;

class SavedJobController extends Controller
{
    public function index()
    {
        $jobs = auth()->user()->savedJobs()->latest()->paginate(9);
        return view('saved.index', compact('jobs'));
    }
    
    public function toggle(JobCircular $job)
    {
        auth()->user()->savedJobs()->toggle($job->id);
        return back()->with('success', 'Updated your saved jobs.');
    }
    
}