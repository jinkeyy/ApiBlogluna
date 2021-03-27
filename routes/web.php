<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerPosts;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Cors;
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
Route::group([
    'module' => 'Api',
    'prefix'=>'auth',
    'namespace' => "\App\Http\Controllers",
    'middleware'=>["cors"]
], function () {
    Route::post('/register', 'UserController@register');
    Route::post('/login',[UserController::class,"login"]);
    Route::post('/logout', 'UserController@logout');
});

Route::group([
    'module' => 'Api',
    'prefix'=>'post',
    'middleware' => ["jwt.auth"]
], function () {
    Route::post('/update',[ControllerPosts::class,"update"])->middleware(Cors::class);
    Route::get('/delete',[ControllerPosts::class,"delete"])->middleware(Cors::class);
    Route::post('/create',[ControllerPosts::class,"create"])->middleware('cors');
});

Route::get('post/show',[ControllerPosts::class,"show"])->middleware('cors');