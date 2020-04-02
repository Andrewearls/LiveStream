<?php

use Illuminate\Support\Facades\Route;
use App\Events\MyEvent;
use Pusher\Pusher;

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

Route::get('/test', function () {
	return view('pusher.test');
});

Route::get('/sender', 'Sender@main');
Route::post('/sender', 'Sender@goLive')->name('goLive');

Route::post('/test', 'Reciever@response')->name('respond');

Route::get('/', function () {
    return view('welcome');
});


