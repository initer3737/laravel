<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\todocontroller;
/*
|--------------------------------------------------------------------------
| Web Routes-----------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/info', function () {
    return view('welcome');
});

//auth route
Route::get('/login', function ($id=null) {
    return view('auth.login');
});


// crud operation
//    index get data from db
Route::get('/',[todocontroller::class,'Index']);
//    index get data by id from db
Route::get('/list/{id}/edit',[todocontroller::class,'IndexId']);
// add data 
Route::post('/list/add',[todocontroller::class,'Store']);
// delete data
Route::get('/list/{id}/delete',[todocontroller::class,'Delete']);
// Route::delete('/list/{id}/delete',[todocontroller::class,'Delete']);
// update
Route::put('/list/{id}/put', [todocontroller::class,'Update']);

