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

Route::get('/sender', function () {
	return view('sender/main');
});

Route::get('/reciever', function () {
	return view('reciever/main');
});

Route::get('/', function () {
    return view('welcome');
});

