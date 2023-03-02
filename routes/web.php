<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\ProfileController;

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
    return view('home');
});

Route::view('/home','home')->name('home');
Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index')->middleware('auth');
Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create')->middleware('auth');
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store')->middleware('auth');
Route::get('/tareas/{tarea}', [TareaController::class, 'show'])->name('tareas.show')->middleware('auth');
Route::get('/tareas/{tarea}/edit', [TareaController::class, 'edit'])->name('tareas.edit')->middleware('auth');
Route::patch('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
