<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('leads',LeadController::class);

    Route::get('/leads/{lead}/tasks/create', [TaskController::class, 'create'])
        ->name('tasks.create');

    Route::post('/leads/{lead}/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');

    Route::get('/leads/{lead}/tasks/{task}/edit', [TaskController::class, 'edit'])
        ->name('tasks.edit');

    Route::put('/leads/{lead}/tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update');

    Route::delete('/leads/{lead}/tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');
});

require __DIR__.'/auth.php';




