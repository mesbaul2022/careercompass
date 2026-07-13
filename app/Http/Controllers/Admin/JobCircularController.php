<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCircular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobCircularController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = JobCircular::latest()->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'category'     => 'required|string',
            'description'  => 'required|string',
            'deadline'     => 'required|date',
            'image'        => 'nullable|image|max:2048',
            'attachment'   => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('job-images', 'public');
        }
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('job-attachments', 'public');
        }

        JobCircular::create($data);

        return redirect()->route('admin.jobs.index')->with('success', 'Job circular published!');
    }
}