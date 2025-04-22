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

// admin side
Route::get('/admin/trash', function () {
    return view('admin.trash');
})->name('admin.users');

Route::get('/admin/users/approved-users', function () {
    return view('admin.users.approved-users');
})->name('admin.users');

Route::get('/admin/users/pending-users', function () {
    return view('admin.users.pending-users');
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



// user side
Route::get('/user/trash', function () {
    return view('user.trash');
})->name('user.users');

Route::get('/user/settings', function () {
    return view('user.settings.index');
})->name('user.settings');

Route::get('/user/settings/profile', function () {
    return view('user.settings.profile');
})->name('user.settings');

Route::get('/user/settings/password', function() {
    return view ('user.settings.password');
})->name('user.settings');

Route::get('/user/tasks/all-tasks', function () {
    return view('user.tasks.all-tasks');
})->name('user.tasks');

Route::get('/user/tasks/to-do', function () {
    return view('user.tasks.to-do');
})->name('user.tasks');

Route::get('/user/tasks/in-progress', function () {
    return view('user.tasks.in-progress');
})->name('user.tasks');

Route::get('/user/tasks/completed', function () {
    return view('user.tasks.completed');
})->name('user.tasks');

Route::get('/dashboard', action: function () {
    return view('user.dashboard');
})->name('user-dashboard');




// landing page
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
