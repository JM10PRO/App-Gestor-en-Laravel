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

Route::get('/incidencia',[TareaController::class, 'crearIncidencia'])->name('crearincidencia');
Route::post('/incidencia', [TareaController::class, 'guardarIncidencia'])->name('guardarincidencia');
// Route::post('/crear-incidencia')->name('crearIncidencia');

Route::group(['middleware' => 'auth', 'namespace' => 'Admin'], function () {

    Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
    
    Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
    
    Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
    
    Route::get('/tareas/{tarea}', [TareaController::class, 'show'])->name('tareas.show');
    
    Route::get('/tareas/{tarea}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
    
    Route::get('/tareas/{tarea}/deleteconfirmation', [TareaController::class, 'deleteConfirmation'])->name('tareas.deleteconfirmation');
    
    Route::patch('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update');
    
    Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy'])->name('tareas.destroy');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
