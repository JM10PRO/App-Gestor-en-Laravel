<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\CuotaController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginGoogleController;
use App\Http\Controllers\OperarioTareaController;
use App\Http\Controllers\PayPalController;

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

// Login Google
Route::get('/login-google', [LoginGoogleController::class, 'googleRedirect'])->name('login-google');
 
Route::get('/google-callback', [LoginGoogleController::class, 'googleCallback']);


// Login GitHub
Route::get('/login-github', [LoginGitHubController::class, 'githubRedirect'])->name('login-github');
 
Route::get('/github-callback', [LoginGitHubController::class, 'githubRedirect']);


// PayPal Payment
Route::get('/paypal/pay/{cuota}',[PayPalController::class, 'payWithPayPal'])->name('paypal-payment');

Route::get('/paypal/status/{cuota}',[PayPalController::class, 'payPalStatus'])->name('paypal-status');

Route::get('/paypal/failed', [PayPalController::class, 'pagoRechazado'])->name('paypal-failed');

// Admin Routes
Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {

    // Admin Tareas
    Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
    
    Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
    
    Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
    
    Route::get('/tareas/{tarea}', [TareaController::class, 'show'])->name('tareas.show');
    
    Route::get('/tareas/{tarea}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
    
    Route::get('/tareas/{tarea}/deleteconfirmation', [TareaController::class, 'deleteConfirmation'])->name('tareas.deleteconfirmation');
    
    Route::patch('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update');
    
    Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy'])->name('tareas.destroy');

    // Admin Clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');

    Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');

    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    // Admin Empleados
    Route::get('/empleados', [UserController::class, 'index'])->name('empleados.index');
    
    Route::get('/empleados/create', [UserController::class, 'create'])->name('empleados.create');
    
    Route::post('/empleados', [UserController::class, 'store'])->name('empleados.store');

    Route::get('/empleados/{empleado}', [UserController::class, 'show'])->name('empleados.show');

    Route::get('/empleados/{empleado}/edit', [UserController::class, 'edit'])->name('empleados.edit');

    Route::patch('/empleados/{empleado}', [UserController::class, 'update'])->name('empleados.update');

    Route::delete('/empleados/{empleado}', [UserController::class, 'destroy'])->name('empleados.destroy');

    // Admin Cuotas
    Route::get('/cuotas', [CuotaController::class, 'index'])->name('cuotas.index');

    Route::post('/cuotas', [CuotaController::class, 'store'])->name('cuotas.store');

    Route::get('/cuotas/mensual', [CuotaController::class, 'crearCuotaMensual'])->name('cuotas.mensual');

    Route::post('/cuotas/mensual', [CuotaController::class, 'guardarCuotaMensual'])->name('cuotas.guardarCuotaMensual');
    
    Route::get('/cuotas/excepcional', [CuotaController::class, 'crearCuotaExcepcional'])->name('cuotas.excepcional');
    
    Route::post('/cuotas/excepcional', [CuotaController::class, 'guardarCuotaExcepcional'])->name('cuotas.guardarCuotaExcepcional');

    Route::get('/cuotas/{cuota}/factura', [CuotaController::class, 'generarFacturaPDF'])->name('cuotas.generarFactura');

    Route::get('/cuotas/{cuota}/edit', [CuotaController::class, 'edit'])->name('cuotas.edit');

    Route::patch('/cuotas/{cuota}', [CuotaController::class, 'update'])->name('cuotas.update');

    Route::delete('/cuotas/{cuota}', [CuotaController::class, 'destroy'])->name('cuotas.destroy');
    
});

Route::group(['middleware' => 'auth'], function () {
    // Operario Tareas
    Route::get('/tareas-operario', [OperarioTareaController::class, 'index'])->name('operario.tareas.index');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
