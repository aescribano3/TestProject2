<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ResourceController;
use App\Models\Course;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'cursos' => Course::orderBy('name', 'asc')->get()
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource("/cursos", CourseController::class)->middleware(['auth', 'verified']);
Route::resource("/recursos", ResourceController::class)->middleware(['auth', 'verified']);

//No entiendo porque estas dos rutas no funcionan
Route::get('/recursos/{curso}', [ResourceController::class, 'indexId'])->middleware(['auth', 'verified'])->name('recursos.indexId');
Route::get('/cursos/json', [CourseController::class, 'json'])->middleware(['auth', 'verified'])->name('cursos.json');

require __DIR__.'/auth.php';
