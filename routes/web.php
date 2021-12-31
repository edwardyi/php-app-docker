<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\ShowOddPage;
use App\Models\Customer;
use App\Models\Phone;
use App\Models\User;
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
Route::get('/customers', 'App\Http\Controllers\CustomerController@index')->name('customers.index');
Route::get('/customers/create', 'App\Http\Controllers\CustomerController@create')->name('customers.create');
// Route::get('/customers/{customerData}', function(Customer $customerData) {return view('customer.show', compact('customerData')); }, 'App\Http\Controllers\CustomerController@show')->middleware('can:view,customerData');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->middleware('can:view,customer');
// Route::get('/customers/{customer}', [CustomerController::class, 'show'])->middleware('can:view,customer'); // ->name('customers.show')
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::patch('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');

// Route::resource('/customers', CustomerController::class); // ->middleware('auth')
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test-random', [App\Http\Controllers\HomeController::class, 'test'])->name('test.odd.page')->middleware(ShowOddPage::class);


Route::get('/test-user-phone', function() {
    $user = User::factory()->create();
    $phone = new Phone();

    $phone->phone = '123-123-1234';
    $user->phone()->save($phone);

    return $phone;
});