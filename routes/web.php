<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
route::get('/',[TaskController::class,'index'])->name('index');
route::post('store',[TaskController::class,'store'])->name('store');
route::get('delete/{id}',[TaskController::class,'delete'])->name('delete');
route::get('edit/{id}',[TaskController::class,'edit'])->name('edit');
route::post('update/{id}',[TaskController::class,'update'])->name('update');
Route::get('changeStatus/{id}',[TaskController::class,'is_active']);

route::get('register',[TaskController::class,'register'])->name('register');
route::post('register',[TaskController::class,'userStore'])->name('user-store');
route::get('login',[TaskController::class,'login'])->name('login');
route::post('login',[TaskController::class,'userLogin'])->name('user-login');

Route::group(['middleware' => 'auth'],function(){
    route::get('dashboard',[TaskController::class,'dashboard'])->name('dashboard');
    route::get('logout',[TaskController::class,'logout'])->name('logout');
});
