<?php

use App\Http\Controllers\StataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
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

Route::get('/', function () {
    return view('welcome');
});


///////////////////////////////////////////////////////////////////////////
/// STata
///////////////////////////////////////////////////////////////////////////
Route::get('/stata', [StataController::class, 'index']);
Route::get('/stata/create', [StataController::class, 'create'])->name('stata.create');
Route::post('/stata/store', [StataController::class, 'store'])->name('stata.store');
/*Route::get('/stata/create', function () {
    return view('welcome');
});
//Route::resource('test', 'TestController');
/*Route::get('test', 'NowayController@index')->name('profile');*/
