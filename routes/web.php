<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. PUBLIC ROUTES (Anyone can view these)
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/jobs', [\App\Http\Controllers\JobPublicController::class, 'index'])->name('jobs.public.index');
Route::get('/jobs/{job}', [\App\Http\Controllers\JobPublicController::class, 'show'])->name('jobs.public.show'); // Fixed: Added missing route

Route::get('/materials', [\App\Http\Controllers\MaterialPublicController::class, 'index'])->name('materials.public.index');


// 2. STANDARD USER ROUTES (Must be logged in)
Route::get('/dashboard', function () {
    return view('dashboard');
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
    Route::resource('syllabi', \App\Http\Controllers\Admin\SyllabusController::class)->except(['show']);
    
    Route::resource('materials', \App\Http\Controllers\Admin\StudyMaterialController::class);
});


// Breeze Auth Routes (Login, Register, Password Reset)
require __DIR__.'/auth.php';