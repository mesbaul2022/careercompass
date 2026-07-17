<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCircular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobCircularController extends Controller
{
    public function index()
    {
        $jobs = JobCircular::latest()->paginate(10);
        $stats = [
            'total'   => JobCircular::count(),
            'active'  => JobCircular::where('deadline', '>=', now())->count(),
            'expired' => JobCircular::where('deadline', '<', now())->count(),
            'users'   => \App\Models\User::where('role', 'user')->count(),
        ];
        return view('admin.jobs.index', compact('jobs', 'stats'));
    }

    public function create() { return view('admin.jobs.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'company_name'     => 'required|string|max:255',
            'company_logo'     => 'nullable|image|max:2048',
            'category'         => 'required|string',
            'location'         => 'nullable|string|max:255',
            'experience'       => 'nullable|string|max:255',
            'salary'           => 'nullable|string|max:255',
            'description'      => 'required|string',
            'requirements'     => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'benefits'         => 'nullable|string',
            'deadline'         => 'required|date',
            'image'            => 'nullable|image|max:2048',
            'attachment'       => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data['user_id'] = auth()->id();

        if ($request->hasFile('company_logo')) {
            $data['company_logo'] = $request->file('company_logo')->store('company-logos', 'public');
        }
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('job-images', 'public');
        }
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('job-attachments', 'public');
        }

        JobCircular::create($data);
        return redirect()->route('admin.jobs.index')->with('success', 'Job circular published!');
    }

    public function edit(JobCircular $job) { return view('admin.jobs.edit', compact('job')); }

    public function update(Request $request, JobCircular $job)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'company_name'     => 'required|string|max:255',
            'company_logo'     => 'nullable|image|max:2048',
            'category'         => 'required|string',
            'location'         => 'nullable|string|max:255',
            'experience'       => 'nullable|string|max:255',
            'salary'           => 'nullable|string|max:255',
            'description'      => 'required|string',
            'requirements'     => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'benefits'         => 'nullable|string',
            'deadline'         => 'required|date',
            'image'            => 'nullable|image|max:2048',
            'attachment'       => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('company_logo')) {
            if ($job->company_logo) Storage::disk('public')->delete($job->company_logo);
            $data['company_logo'] = $request->file('company_logo')->store('company-logos', 'public');
        }
        if ($request->hasFile('image')) {
            if ($job->image) Storage::disk('public')->delete($job->image);
            $data['image'] = $request->file('image')->store('job-images', 'public');
        }
        if ($request->hasFile('attachment')) {
            if ($job->attachment) Storage::disk('public')->delete($job->attachment);
            $data['attachment'] = $request->file('attachment')->store('job-attachments', 'public');
        }

        $job->update($data);
        return redirect()->route('admin.jobs.index')->with('success', 'Job circular updated!');
    }

    public function destroy(JobCircular $job)
    {
        if ($job->company_logo) Storage::disk('public')->delete($job->company_logo);
        if ($job->image) Storage::disk('public')->delete($job->image);
        if ($job->attachment) Storage::disk('public')->delete($job->attachment);
        
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job circular deleted.');
    }
}