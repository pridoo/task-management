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

Route::get('/admin/users/approved-users', function () {
    return view('admin.users.approved-users');
})->name('admin.users');


Route::get('/admin/reports', function () {
    return view('admin.reports');
})->name('admin.reports');

Route::get('/admin/settings', function () {
    return view('admin.settings.index');
})->name('admin.settings');

Route::get('/admin/settings/profile', function () {
    return view('admin.settings.profile');
})->name('admin.settings');

Route::get('/admin/settings/password', function() {
    return view ('admin.settings.password');
})->name('admin.settings');

Route::get('/admin/tasks/all-tasks', function () {
    return view('admin.tasks.all-tasks');
})->name('admin.tasks');

Route::get('/admin/tasks/to-do', function () {
    return view('admin.tasks.to-do');
})->name('admin.tasks');

Route::get('/admin/tasks/in-progress', function () {
    return view('admin.tasks.in-progress');
})->name('admin.tasks');

Route::get('/admin/tasks/completed', function () {
    return view('admin.tasks.completed');
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
