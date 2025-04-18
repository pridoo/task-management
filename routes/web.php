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

Route::get('/admin/tasks', function () {
    return view('admin.tasks.all-tasks');
})->name('admin.tasks');

Route::get('/admin/dashboard', action: function () {
    return view('admin.dashboard');
})->name('admin-dashboard');

Route::get('/', function () {
    return view('landing_page.index');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login2', function () {
    return view('auth.login2');
})->name('login2');
