<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerPosts;

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
    'namespace' => "\App\Http\Controllers"
], function () {
    Route::post('/register', 'UserController@register');
    Route::post('/login', 'UserController@login');
    Route::post('/logout', 'UserController@logout');

});
Route::group([
    'module' => 'Api',
    'prefix'=>'post',
    'middleware' => ["jwt.auth"]
], function () {
    Route::post('/create',[ControllerPosts::class,"create"]);
    Route::post('/update',[ControllerPosts::class,"update"]);
    Route::get('/delete',[ControllerPosts::class,"delete"]);
});
Route::get('post/show',[ControllerPosts::class,"show"])->middleware("cors");;