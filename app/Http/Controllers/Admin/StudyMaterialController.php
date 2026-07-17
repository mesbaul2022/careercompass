<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudyMaterialController extends Controller
{
    public function index()
    {
        $materials = StudyMaterial::latest()->get();
        return view('admin.materials.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.materials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string',
            'title'    => 'required|string|max:255',
            'file'     => 'required|file|mimes:pdf|max:5120',
        ]);

        $data['file_path'] = $request->file('file')->store('study-materials', 'public');
        
        StudyMaterial::create($data);
        
        return redirect()->route('admin.materials.index')->with('success', 'Material uploaded!');
    }

    public function destroy(StudyMaterial $material)
    {
        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }
        $material->delete();
        
        return redirect()->route('admin.materials.index')->with('success', 'Material deleted.');
    }
}