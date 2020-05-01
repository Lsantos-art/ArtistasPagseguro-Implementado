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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('boleto', function () {
    return view('boleto');
})->name('boleto');

Route::get('card', function () {
    return view('card');
})->name('card');


Route::get('boletoPay', 'PagSeguroController@boleto')->name('boletoPay');
Route::post('cardPay', 'PagSeguroController@cardPay')->name('cardPay');
