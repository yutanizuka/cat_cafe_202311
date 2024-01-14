<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminBlogController;
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
    return view('index');
});

Route::get('/contact',[\App\Http\Controllers\ContactController::class,'index'])->name('contact');
Route::post('/contact',[\App\Http\Controllers\ContactController::class,'sendmail']);
Route::get('/contact/complete',[\App\Http\Controllers\ContactController::class,'complete'])->name('contact.complete');

// management window
Route::prefix('/admin')
->name('admin.')
->group(function() {
    // ログイン時のみアクセス可能なルート
    Route::middleware('auth')
    ->group(function (){
//ブログ
        Route::resource('/blogs', AdminBlogController::class)->except('show');
//user　management
        Route::get('/users/create',[UserController::class,'create'])->name('users.create');
        Route::post('/users',[UserController::class,'store'])->name('users.store');
        Route::post('/logout', [AuthController::class,'logout'])->name('logout');

        });

        //未ログイン時のみアクセス可能なルート
        Route::middleware('guest')
            ->group(function(){
                //Auth
                Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
                Route::post('/admin/login', [AuthController::class, 'login']);

            });
    });



