<?php

namespace App\Http\Controllers;

use App\Models\JobCircular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class JobPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = JobCircular::latest();

        $category = $request->category ?? $request->cookie('preferred_category');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
            Cookie::queue('preferred_category', $request->category, 60 * 24 * 30);
        }
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $jobs = $query->paginate(9)->withQueryString();

        return view('jobs.index', compact('jobs', 'category'));
    }

    public function show(\App\Models\JobCircular $job)
    {
        $syllabus = \App\Models\Syllabus::where('category', $job->category)->first();
        
        $similarJobs = \App\Models\JobCircular::where('category', $job->category)
            ->where('id', '!=', $job->id)
            ->latest()
            ->take(3)
            ->get();
            
        return view('jobs.show', compact('job', 'syllabus', 'similarJobs'));
    }
}