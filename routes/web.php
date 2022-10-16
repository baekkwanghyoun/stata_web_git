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
| edit master
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [StataController::class, 'quasar'])->name('quasar.index');


Route::get('/phpinfo', function () {
    return  phpinfo();;
});

Route::get('/gatest', [StataController::class, 'gatest'])->name('quasar.index');
Route::get('/getmac', [StataController::class, 'getmacAddr'])->name('getmacAddr');


/*
Route::get('/khp', [StataController::class, 'khp'])->name('khp');*/


///////////////////////////////////////////////////////////////////////////
/// STata
///////////////////////////////////////////////////////////////////////////

Route::get('/chart', [StataController::class, 'chart'])->name('chart.index');

Route::get('/quasar', [StataController::class, 'quasar'])->name('quasar.index');
Route::get('/klipstest', function () {
    return view('stata.klipstest');
});




Route::get('/klips/smartklips', [StataController::class, 'quasar'])->name('quasar.index');
Route::get('/klips/smartklips.do', [StataController::class, 'quasar'])->name('quasar.index');
//Route::get('/klips/smartklips', [StataController::class, 'quasar'])->name('quasar.index');

Route::get('/stata', [StataController::class, 'index'])->name('stata.index');
Route::get('/stata2', [StataController::class, 'index2']);
Route::get('/stata/create', [StataController::class, 'create'])->name('stata.create');
Route::post('/stata/store', [StataController::class, 'store'])->name('stata.store');
Route::post('/stata/storeKlips', [StataController::class, 'storeKlips'])->name('stata.storeKlips'); //storeKlipsapi api라우터에서 대체 처리

/*Route::get('/stata/create', function () {
    return view('welcome');
});
//Route::resource('test', 'TestController');
/*Route::get('test', 'NowayController@index')->name('profile');*/


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/stat/savefiletype', [\App\Http\Controllers\StatsController::class, 'savefiletype'])->name('stat.savefiletype');
    Route::get('/stat/visit', [\App\Http\Controllers\Voyager\VisitController::class, 'index'])->name('stat.visit');
    Route::get('/stat/browser', [\App\Http\Controllers\Voyager\VisitController::class, 'index'])->name('stat.browser');
    Route::get('/stat/os', [\App\Http\Controllers\Voyager\VisitController::class, 'index'])->name('stat.visit');
});
