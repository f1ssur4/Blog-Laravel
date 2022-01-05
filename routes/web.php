<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

Route::any('/', [HomeController::class, 'index']);
Route::get('/post/{id}', [HomeController::class, 'post']);
Route::get('/reviews', [HomeController::class, 'reviews']);
Route::get('/review/create', [HomeController::class, 'reviewCreate']);
Route::get('/login', [HomeController::class, 'loginForm']);
Route::post('/signing', [HomeController::class, 'signing']);
Route::get('/exit', [HomeController::class, 'exit']);
Route::get('/signup', [HomeController::class, 'signupCreateForm']);
Route::get('/signup/create', [HomeController::class, 'createUser']);
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/delete', [AdminController::class, 'delete']);
Route::get('/admin/publish', [AdminController::class, 'publish']);
Route::post('/admin/create', [AdminController::class, 'createPost']);
Route::get('/admin/save', [AdminController::class, 'save']);

