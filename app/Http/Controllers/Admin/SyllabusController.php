<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Syllabus;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{
    public function index()
    {
        $syllabi = Syllabus::latest()->get();
        return view('admin.syllabi.index', compact('syllabi'));
    }

    public function create()
    {
        return view('admin.syllabi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string',
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
        ]);

        Syllabus::create($data);

        return redirect()->route('admin.syllabi.index')->with('success', 'Syllabus added!');
    }

    public function edit(Syllabus $syllabus)
    {
        return view('admin.syllabi.edit', compact('syllabus'));
    }

    public function update(Request $request, Syllabus $syllabus)
    {
        $data = $request->validate([
            'category' => 'required|string',
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
        ]);

        $syllabus->update($data);

        return redirect()->route('admin.syllabi.index')->with('success', 'Syllabus updated!');
    }

    public function destroy(Syllabus $syllabus)
    {
        $syllabus->delete();
        return redirect()->route('admin.syllabi.index')->with('success', 'Syllabus deleted.');
    }
}