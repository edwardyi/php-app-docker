<?php

use App\Http\Controllers\CustomerController;
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
    return view('home');
});

Route::view('/contact', 'contact');
Route::view('/about', 'about');

Route::get('/customer-test', function() {
    $customers = [
        'John Doe',
        'Jane Doe',
        'Bob The Builder'
    ];
    return view('internals.customer', [
        'customers' => $customers
    ]);
});


// https://stackoverflow.com/questions/63807930/target-class-controller-does-not-exist-laravel-8
// Route::get('/customers', [CustomerController::class, "list"]);
Route::get('/customers', 'App\Http\Controllers\CustomerController@index');
Route::get('/customers/create', 'App\Http\Controllers\CustomerController@create');
Route::post('/customers', [CustomerController::class, 'store']);