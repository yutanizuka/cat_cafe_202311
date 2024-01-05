<?php

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

Route::get('/', function () {
    return view('index');
});

Route::get('/contact',[\App\Http\Controllers\ContactController::class,'index'])->name('contact');
Route::post('/contact',[\App\Http\Controllers\ContactController::class,'sendmail']);
Route::get('/contact/complete',[\App\Http\Controllers\ContactController::class,'complete'])->name('contact.complete');

//ブログ
Route::get('/admin/blogs',[\App\Http\Controllers\Admin\AdminBlogController::class,'index'])->name('admin.blogs.index');
Route::get('/admin/blogs/create',[\App\Http\Controllers\Admin\AdminBlogController::class,'create'])->name('admin.blogs.create');
Route::post('/admin/blogs',[\App\Http\Controllers\Admin\AdminBlogController::class,'store'])->name('admin.blogs.store');
Route::get('/admin/blogs/{blog}',[\App\Http\Controllers\Admin\AdminBlogController::class,'edit'])->name('admin.blogs.edit');
Route::put('/admin/blogs/{blog}',[\App\Http\Controllers\Admin\AdminBlogController::class,'update'])->name('admin.blogs.update');
Route::delete('/admin/blogs/{blog}',[\App\Http\Controllers\Admin\AdminBlogController::class,'destroy'])->name('admin.blogs.destroy');
