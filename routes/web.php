<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });
Route::view('/','welcome')->name('home');
Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
Route::get('/tareas/{tarea}', [TareaController::class, 'show'])->name('tareas.show');