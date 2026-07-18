<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. PUBLIC ROUTES (Anyone can view these)
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/jobs', [\App\Http\Controllers\JobPublicController::class, 'index'])->name('jobs.public.index');
Route::get('/jobs/{job}', [\App\Http\Controllers\JobPublicController::class, 'show'])->name('jobs.public.show'); // Fixed: Added missing route

Route::get('/materials', [\App\Http\Controllers\MaterialPublicController::class, 'index'])->name('materials.public.index');


//STANDARD USER ROUTES (Must be logged in)
Route::get('/dashboard', function () {
    // If the user is an admin, send them to the Admin Dashboard (where + New Circular is)
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.jobs.index');
    }
    // If it is a normal user, send them to the Job Listings (Screenshot 4)
    return redirect()->route('jobs.public.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Saved Jobs
    Route::post('/jobs/{job}/save', [\App\Http\Controllers\SavedJobController::class, 'toggle'])->name('saved.toggle');
    Route::get('/saved-jobs', [\App\Http\Controllers\SavedJobController::class, 'index'])->name('saved.index');
    
    // Profile Management (Breeze Default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// 3. ADMIN ROUTES (log in as Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('jobs', \App\Http\Controllers\Admin\JobCircularController::class);
    // Approval Route
    Route::patch('jobs/{job}/approve', [\App\Http\Controllers\Admin\JobCircularController::class, 'approve'])->name('jobs.approve'); 
    // Applications Viewer Route
    Route::get('jobs/{job}/applications', [\App\Http\Controllers\ApplicationController::class, 'index'])->name('jobs.applications');
    Route::resource('jobs', \App\Http\Controllers\Admin\JobCircularController::class);
    Route::resource('syllabi', \App\Http\Controllers\Admin\SyllabusController::class)->except(['show']);
    
    Route::resource('materials', \App\Http\Controllers\Admin\StudyMaterialController::class);
});


// Breeze Auth Routes (Login, Register, Password Reset)
require __DIR__.'/auth.php';