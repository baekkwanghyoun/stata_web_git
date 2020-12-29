<?php

use App\Http\Controllers\StataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
http://52.79.82.226/js/vendor.e0c8d7d6.js
http://52.79.82.226/js/app.d67cb343.js
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/stata/storeKlipsApi', [StataController::class, 'storeKlipsApi'])->name('stata.storeKlipsApi');
Route::post('/stata/storeKlipsApi', [StataController::class, 'storeKlips'])->name('stata.storeKlips');
Route::post('/stata/searchKlipsApi', [StataController::class, 'searchKlips'])->name('stata.searchKlips');

/*Route::get('/stata/store', [StataController::class, 'store'])->name('stata.store');*/
