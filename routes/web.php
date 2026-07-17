<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('jobs', \App\Http\Controllers\Admin\JobCircularController::class);
    Route::resource('syllabi', \App\Http\Controllers\Admin\SyllabusController::class)->except(['show']);
});

Route::middleware('auth')->group(function () {
    Route::post('/jobs/{job}/save', [\App\Http\Controllers\SavedJobController::class, 'toggle'])->name('saved.toggle');
    Route::get('/saved-jobs', [\App\Http\Controllers\SavedJobController::class, 'index'])->name('saved.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/jobs', [\App\Http\Controllers\JobPublicController::class, 'index'])->name('jobs.public.index');
Route::resource('materials', \App\Http\Controllers\Admin\StudyMaterialController::class);
Route::get('/materials', [\App\Http\Controllers\MaterialPublicController::class, 'index'])->name('materials.public.index');

require __DIR__.'/auth.php';
