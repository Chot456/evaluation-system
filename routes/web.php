<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\UserAuthController;

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
    return view('auth.user-login');
});


Route::get('userRegister', function () {
    return view('auth.user-register');
});
Route::get('userLogin', [UserAuthController::class, 'login']);

//route data
Route::get('userRegister', [UserAuthController::class, 'register'])->name('auth.register');

// insert data
Route::post('createUser', [UserAuthController::class, 'create'])->name('auth.create');
Route::post('check', [UserAuthController::class, 'check'])->name('auth.check');
// Route::get('home#/logout', [UserAuthController::class, 'logOut']);




// Auth::routes();
// Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('isLogged');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('auth.home')->middleware('isLogged');
Route::get('/home', function(){
    if (!session()->has('LoggedUser')) {
        return view('auth.user-login');
    }
    return view('spa');
});

Route::get('/getSession', function() {
    return session('LoggedUser');   
});

Route::get('/logout', function(){
    if (session()->has('LoggedUser')) {
        session()->pull('LoggedUser');
        return view('auth.user-login');
    }
    return view('auth.user-login');
});


Route::get('/{any}', 'App\Http\Controllers\HomeController@index')->where('any', '.*');
//Route::get('/{any}', 'App\Http\Controllers\HomeController@index')->where('vue', '[\/\w\.-]*');

