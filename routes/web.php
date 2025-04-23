<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FileDownloadController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;

// Public Homepage
Route::view('/', 'welcome');

// Public Resource Browsing (read-only)
Route::resource('galleries', GalleryController::class)->only(['index', 'show']);
Route::resource('news', NewsController::class)->only(['index', 'show']);
Route::resource('downloads', FileDownloadController::class)->only(['index']);
Route::resource('regions', RegionController::class)->only(['index']);

// Shared Dashboard (auth + email verified)
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {

    // Public & Admin roles
    Route::middleware('role:admin,public')->group(function () {
        Route::resource('reports', ReportController::class)->only(['create', 'store', 'show']);

        Route::get('/my-reports', function () {
            $myReports = \App\Models\Report::where('user_id', auth()->id())->get();
            return view('reports.my', compact('myReports'));
        })->name('reports.mine');
    });

    // Admin-Only Routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

        // Full management access
        Route::resource('galleries', GalleryController::class)->except(['index', 'show']);
        Route::resource('news', NewsController::class)->except(['index', 'show']);
        Route::resource('downloads', FileDownloadController::class)->except(['index']);
        Route::resource('regions', RegionController::class)->except(['index']);
        Route::resource('reports', ReportController::class)->only(['index', 'edit', 'update', 'destroy']);
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes from Laravel Breeze
require __DIR__.'/auth.php';
