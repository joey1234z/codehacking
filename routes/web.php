<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\adminUserController;
use App\Http\Controllers\adminRoleController;
use App\Http\Controllers\AdminPostController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Auth;




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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin.index');
    // @extendes('layouts.admin') in the admin index.blade
});

//Route::group(['middleware'=>[Admin::class, Auth::class]], function(){
Route::middleware(['middleware'=>'isAdmin'])->group(function(){
    Route::resource('admin/users', adminUserController::class, ['as' => 'admin']);
    Route::resource('admin/roles', adminRoleController::class, ['as' => 'admin']);
    Route::resource('admin/posts', AdminPostController::class, ['as' => 'admin']);
//});    
});



require __DIR__.'/auth.php';
