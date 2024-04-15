<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;

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

Route::get('/test', function(){
    return response([
        'message' => 'Api working'
    ], 200);
});


Route::post('/register', [AuthenticationController::class, 'register']);

Route::post('/token', [AuthenticationController::class, 'token']);

Route::post('/login', [AuthenticationController::class, 'login']);
