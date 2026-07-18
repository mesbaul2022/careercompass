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
        $user = auth()->user();

        // If organization, only show THEIR jobs. If admin, show ALL jobs.
        if ($user->role === 'organization') {
            $jobs = JobCircular::where('user_id', $user->id)->latest()->paginate(10);
            $stats = [
                'total'   => JobCircular::where('user_id', $user->id)->count(),
                'active'  => JobCircular::where('user_id', $user->id)->where('status', 'approved')->where('deadline', '>=', now())->count(),
                'pending' => JobCircular::where('user_id', $user->id)->where('status', 'pending')->count(),
                'users'   => 0, // Orgs don't need to see total system users
            ];
        } else {
            $jobs = JobCircular::latest()->paginate(10);
            $stats = [
                'total'   => JobCircular::count(),
                'active'  => JobCircular::where('status', 'approved')->where('deadline', '>=', now())->count(),
                'pending' => JobCircular::where('status', 'pending')->count(),
                'users'   => \App\Models\User::where('role', 'user')->count(),
            ];
        }

        return view('admin.jobs.index', compact('jobs', 'stats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // ... your existing validation array ...
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
        
        // Admins skip approval. Organizations go to pending.
        $data['status'] = auth()->user()->role === 'admin' ? 'approved' : 'pending';

        // ... your existing file upload logic ...
        if ($request->hasFile('company_logo')) $data['company_logo'] = $request->file('company_logo')->store('company-logos', 'public');
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('job-images', 'public');
        if ($request->hasFile('attachment')) $data['attachment'] = $request->file('attachment')->store('job-attachments', 'public');

        JobCircular::create($data);
        
        $msg = auth()->user()->role === 'admin' ? 'Job published!' : 'Job submitted and is waiting for admin approval.';
        return redirect()->route('admin.jobs.index')->with('success', $msg);
    }

    // NEW METHOD: Handle Approval
    public function approve(JobCircular $job)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        
        $job->update(['status' => 'approved']);
        return back()->with('success', 'Job circular has been approved and is now public.');
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