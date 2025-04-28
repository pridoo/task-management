<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdNumberAuthController;
use App\Http\Controllers\Admin\TaskController;

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'admin'])->group(function () {
    Route::get('/trash', fn() => view('admin.trash'))->name('trash');
    Route::get('/users/approved-users', fn() => view('admin.users.approved-users'))->name('approved-users');
    Route::get('/users/pending-users', fn() => view('admin.users.pending-users'))->name('pending-users');
    Route::get('/reports', fn() => view('admin.reports'))->name('reports');

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', fn() => view('admin.settings.index'))->name('index');
        Route::get('/profile', fn() => view('admin.settings.profile'))->name('profile');
        Route::get('/password', fn() => view('admin.settings.password'))->name('password');
    });

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/all-tasks', [TaskController::class, 'index'])->name('tasks.all-tasks');
        Route::post('/store', [TaskController::class, 'store'])->name('store');
        Route::put('/{task}/update', [TaskController::class, 'update'])->name('update');
        Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::delete('/{task}/destroy', [TaskController::class, 'destroy'])->name('destroy');
        Route::get('/to-do', [TaskController::class, 'todo'])->name('tasks.to-do');
        Route::get('/in-progress', [TaskController::class, 'inprogress'])->name('tasks.in-progress');
        Route::get('/completed', [TaskController::class, 'completed'])->name('tasks.completed');
    });

    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
});

Route::prefix('user')->name('user.')->middleware(['auth', 'user'])->group(function () {
    Route::get('/trash', fn() => view('user.trash'))->name('trash');

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', fn() => view('user.settings.index'))->name('index');
        Route::get('/profile', fn() => view('user.settings.profile'))->name('profile');
        Route::get('/password', fn() => view('user.settings.password'))->name('password');
    });

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/all-tasks', fn() => view('user.tasks.all-tasks'))->name('all-tasks');
        Route::get('/to-do', fn() => view('user.tasks.to-do'))->name('to-do');
        Route::get('/in-progress', fn() => view('user.tasks.in-progress'))->name('in-progress');
        Route::get('/completed', fn() => view('user.tasks.completed'))->name('completed');
    });

    Route::get('/dashboard', fn() => view('user.dashboard'))->name('dashboard');
});


Route::get('/', fn() => view('landing_page.index'))->name('home');
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/login/id-number', fn() => view('auth.login2'))->name('login2');
Route::post('/login', [AuthController::class, 'checkLogin'])->name('checkLogin');
Route::post('/login/id-number', [IdNumberAuthController::class, 'loginWithId'])->name('loginWithId');


Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

