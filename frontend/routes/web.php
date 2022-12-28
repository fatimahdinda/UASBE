<?php

use App\Http\Controllers\Agama45Controller;
use App\Http\Controllers\Auth45Controller;
use App\Http\Controllers\User45Controller;
use App\Http\Controllers\Detaildata45Controller;
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
    return view('welcome', [
        'page' => "Home"
    ]);
})->middleware('auth');


// auth
Route::get('/login45', [Auth45Controller::class, 'login'])->name('login');
Route::get('/register45', [Auth45Controller::class, 'register'])->name('auth45.register');
Route::get('/logout45', [Auth45Controller::class, 'logout'])->name('auth45.logout');

Route::post('/login45', [Auth45Controller::class, 'loginP'])->name('auth45.loginP');
Route::post('/register45', [Auth45Controller::class, 'registerP'])->name('auth45.registerP');

Route::middleware('auth')->group(function () {
    // agama
    Route::resource('/agama45', Agama45Controller::class)->middleware('admin');

    // my
    Route::get('/myprofile45', [User45Controller::class, 'myprofile'])->name('user45.myprofile');
    Route::put('/myprofile45/edit/image/{id}', [User45Controller::class, 'editimage'])->name('user45.editimage');
    Route::put('/myprofile45/edit/password/{id}', [User45Controller::class, 'editpassword'])->name('user45.editpassword');

    // user
    Route::resource('/user45', User45Controller::class)->middleware('admin');

    // detail
    Route::resource('/detaildata45', Detaildata45Controller::class);
});
