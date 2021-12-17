<?php

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

// Route::get('/', function () {
//     return view(theme().'.odds');
// });


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/item/{id}', [App\Http\Controllers\HomeController::class, 'item']);
Route::get('/view/{slug}', [App\Http\Controllers\HomeController::class, 'view']);
Route::get('/cat/{id}', [App\Http\Controllers\HomeController::class, 'cat']);

Route::get('/odds', function () {
    return view(theme().'.odds',[
        'active' => 'odds'
    ]);
});
Route::get('/livescore', function () {
    return view(theme().'.livescore',[
        'active' => 'livescore'
    ]);
});
Route::get('/watch', function () {
    return view(theme().'.watch',[
        'active' => 'watch',
        'uri' => $_REQUEST['req']
    ]);
});
Route::get('/live', function () {
    return view(theme().'.live',[
        'active' => 'live'
    ]);
});

Route::get('/ch', [App\Http\Controllers\HomeController::class, 'liveCh']);
Route::post('/line-notify', [App\Http\Controllers\HomeController::class, 'lineNotify']);

Route::get('/test', function () {
    // return get_zft();

    return view(theme().'.test',[
        'active' => 'test'
    ]);
});