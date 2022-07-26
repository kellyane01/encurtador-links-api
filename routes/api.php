<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LinkCurtoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/link', '\App\Http\Controllers\LinkController@index');

Route::get('/links', [LinkController::class, 'index'])->name('links.index');
Route::post('/links/store', [LinkController::class, 'store'])->name('links.store');
Route::post('/links/destroy', [LinkController::class, 'destroy'])->name('links.destroy');

Route::get('/links-curtos', [LinkCurtoController::class, 'index'])->name('links_curtos.index');
Route::get('/links-curtos/store', [LinkCurtoController::class, 'store'])->name('links_curtos.store');
Route::get('/links-curtos/destroy', [LinkCurtoController::class, 'destroy'])->name('links_curtos.destroy');
Route::get('/links-curtos/destroy', [LinkCurtoController::class, 'destroy'])->name('links_curtos.destroy');
Route::get('/redirect/{codigo}', [LinkCurtoController::class, 'redirecionamento'])->name('links_curtos.redirect');
