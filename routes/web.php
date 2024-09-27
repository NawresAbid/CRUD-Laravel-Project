<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Liste_UserController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\Add_UserController ;
use App\Http\Controllers\DashbordController ;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//register route
Route::get('/register_view', [App\Http\Controllers\RegisterController::class, 'register_view'])->name('register_view');
Route::post('/save_user', [App\Http\Controllers\RegisterController::class, 'save_user'])->name('save_user');
//login route
Route::get('/login_view',[App\Http\Controllers\LoginController::class,'login_view'])->name('login_view');
Route::get('/login_user', [App\Http\Controllers\LoginController::class, 'login_user'])->name('login_user');
//listusers route
Route::get('/list_users',[App\Http\Controllers\Liste_UserController::class, 'listUsers'])->name('listUsers');
//update route
Route::get('/update_view/{id}/{name}/{email}', [App\Http\Controllers\UpdateController::class, 'update_view'])->name('update_view');
Route::post('/update_user', [App\Http\Controllers\UpdateController::class, 'update_user'])->name('update_user');
//delete route
Route::get('/delete_user/{email}', [UpdateController::class, 'deleteUser'])->name('delete_user');


Route::post('/add_user',[App\Http\Controllers\Liste_UserController::class, 'add_user'])->name('add_user');
Route::get('/Search_user',[App\Http\Controllers\Liste_UserController::class, 'Search_user'])->name('Search_user');
Route::get('/logout', [App\Http\Controllers\Liste_UserController::class, 'logout'])->name('logout');
Route::get('index', [App\Http\Controllers\DashbordController::class,'index'])->name('index');