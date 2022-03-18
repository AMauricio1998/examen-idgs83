<?php

use App\Http\Controllers\tiendaController;
use Illuminate\Support\Facades\Route;

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

Route::name('welcome')->get('/', [tiendaController::class, 'index']);
Route::name('fotoTienda')->get('/fotoTienda', [tiendaController::class, 'fotoTienda']);
Route::name('fotoEmpleado')->get('/fotoEmpleado', [tiendaController::class, 'fotoEmpleado']);
Route::name('productos')->get('/productos', [tiendaController::class, 'productos']);
Route::name('altaProductosVentas')->post('/altaProductosVentas', [tiendaController::class, 'altaProductosVentas']);
Route::name('borrar')->delete('borrar/{id}', [tiendaController::class, 'borrar']);
