<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Projects Management
    Route::get('/projects', [AdminController::class, 'projects'])->name('projects');
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('projects.store');
    Route::put('/projects/{project}', [AdminController::class, 'updateProject'])->name('projects.update');
    Route::delete('/projects/{project}', [AdminController::class, 'destroyProject'])->name('projects.destroy');
    
    // Gallery Management
    Route::get('/gallery', [AdminController::class, 'gallery'])->name('gallery');
    Route::post('/gallery', [AdminController::class, 'storeGallery'])->name('gallery.store');
    Route::put('/gallery/{gallery}', [AdminController::class, 'updateGallery'])->name('gallery.update');
    Route::delete('/gallery/{gallery}', [AdminController::class, 'destroyGallery'])->name('gallery.destroy');
});
