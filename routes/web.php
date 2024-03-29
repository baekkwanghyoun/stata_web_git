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
Route::group(['prefix' => 'api'], function () {
    Route::get('/getcode/{group}', [\App\Http\Controllers\SettingsController::class, 'getCode']);
    Route::get('/howto/', [\App\Http\Controllers\HowtosController::class, 'index']);
    Route::get('/faq/', [\App\Http\Controllers\FaqsController::class, 'index']);
    Route::get('/getclientip/', [\App\Http\Controllers\SettingsController::class, 'getIp']);
});


/*
Route::get('/phpinfo', function () {
    return  phpinfo();;
});*/

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
Route::post('/stata/store', [StataController::class, 'store'])->name('stata.store');
Route::post('/stata/storeKlips', [StataController::class, 'storeKlips'])->name('stata.storeKlips'); //storeKlipsapi api라우터에서 대체 처리

/*Route::get('/stata/create', function () {
    return view('welcome');
});
//Route::resource('test', 'TestController');
/*Route::get('test', 'NowayController@index')->name('profile');*/


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('/auth/pwchange', [\TCG\Voyager\Http\Controllers\VoyagerController::class, 'pwchange'])->middleware('admin.user')->name('voyager.pwchange');
    Route::post('/auth/pwchangeupdate', [\TCG\Voyager\Http\Controllers\VoyagerController::class, 'pwchangeUpdate'])->name('voyager.pwchange.update');


    Route::any('/stat/savefiletype', [\App\Http\Controllers\StatsController::class, 'savefiletype'])->name('stat.savefiletype');
    Route::any('/stat/visit', [\App\Http\Controllers\Voyager\VisitController::class, 'index'])->name('stat.visit');
    Route::any('/stat/browser', [\App\Http\Controllers\Voyager\VisitController::class, 'index'])->name('stat.browser');
    Route::any('/stat/os', [\App\Http\Controllers\Voyager\VisitController::class, 'index'])->name('stat.visit');

    Route::any('/analysis/{type}', [\App\Http\Controllers\AnalysisController::class, 'index'])->name('stat.analysis');
});
