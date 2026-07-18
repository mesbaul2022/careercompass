<?php

namespace App\Http\Controllers;

use App\Models\JobCircular;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function create(JobCircular $job)
    {
        // Check if user has already applied
        $hasApplied = JobApplication::where('user_id', auth()->id())
                                    ->where('job_circular_id', $job->id)
                                    ->exists();
        
        if ($hasApplied) {
            return redirect()->route('jobs.public.show', $job)
                             ->with('error', 'You have already submitted an application for this position.');
        }

        return view('jobs.apply', compact('job'));
    }

    public function store(Request $request, JobCircular $job)
    {
        // Prevent double submission
        if (JobApplication::where('user_id', auth()->id())->where('job_circular_id', $job->id)->exists()) {
            return redirect()->route('jobs.public.show', $job)->with('error', 'You have already applied.');
        }

        $data = $request->validate([
            'phone'             => 'required|string|max:20',
            'highest_education' => 'required|string|max:255',
            'experience_years'  => 'required|string|max:50',
            'cover_letter'      => 'nullable|string',
            'cv'                => 'required|file|mimes:pdf|max:5120', // 5MB Max PDF
        ]);

        JobApplication::create([
            'job_circular_id'   => $job->id,
            'user_id'           => auth()->id(),
            'phone'             => $data['phone'],
            'highest_education' => $data['highest_education'],
            'experience_years'  => $data['experience_years'],
            'cover_letter'      => $data['cover_letter'],
            'cv_path'           => $request->file('cv')->store('resumes', 'public'),
        ]);

        return redirect()->route('jobs.public.show', $job)
                         ->with('success', 'Your application has been submitted successfully!');
    }
}