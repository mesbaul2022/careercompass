<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $latestJobs = \App\Models\JobCircular::latest()->take(6)->get();
        return view('home', compact('latestJobs'));
    }
}