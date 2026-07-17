<?php
namespace App\Http\Controllers;

use App\Models\StudyMaterial;
use Illuminate\Http\Request;

class MaterialPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = StudyMaterial::latest();
        
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        $materials = $query->paginate(9)->withQueryString();
        
        return view('materials.index', compact('materials'));
    }
}