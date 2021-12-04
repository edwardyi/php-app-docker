<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\ShowOddPage;
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

Route::get('/contact', [ContactController::class, 'create']);
Route::post('/contact', [ContactController::class, 'store']);

Route::view('/about', 'about')->middleware('show.odd.page');

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
// Route::get('/customers', 'App\Http\Controllers\CustomerController@index');
// Route::get('/customers/create', 'App\Http\Controllers\CustomerController@create');
// Route::get('/customers/{customer}', [CustomerController::class, 'show']);
// Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit']);
// Route::post('/customers', [CustomerController::class, 'store']);
// Route::patch('/customers/{customer}', [CustomerController::class, 'update']);
// Route::delete('/customers/{customer}', [CustomerController::class, 'destroy']);

Route::resource('/customers', CustomerController::class); // ->middleware('auth')
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test-random', [App\Http\Controllers\HomeController::class, 'test'])->middleware(ShowOddPage::class);