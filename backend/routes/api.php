<?php

use App\Http\Controllers\Api\Agama45Controller;
use App\Http\Controllers\api\Detaildata45Controller;
use App\Http\Controllers\api\User45Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route::resource('/agama45', Agama45Controller::class);

route::resource('/detaildata45', DetailData45Controller::class);

route::resource('/user45', User45Controller::class);
Route::put('/user45/update/image/{id}', [User45Controller::class, 'editimage'])->name('user45.editimage');
Route::put('/user45/update/password/{id}', [User45Controller::class, 'editpassword'])->name('user45.editpassword');

// detail
route::resource('/detaildata45', Detaildata45Controller::class);
