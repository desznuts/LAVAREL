<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
   
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projects', ProjectController::class);

    Route::get('/projects/{project}/download', [ProjectController::class, 'download'])->name('projects.download');
    Route::get('/projects/{project}/preview', [ProjectController::class, 'preview'])->name('projects.preview');


});

require __DIR__.'/auth.php';
