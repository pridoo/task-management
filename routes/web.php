<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdNumberAuthController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\PendingUserController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TrashController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\User\TasksController;
use App\Http\Controllers\User\ProfilesController;
use App\Http\Controllers\User\UserDashboardController;


Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'admin'])->group(function () {


    Route::get('users/pending-users', [PendingUserController::class, 'showPendingUsers'])->name('pending-users');
    Route::put('users/approve-user/{userId}', [PendingUserController::class, 'approveUser'])->name('approve-user');
    Route::put('reject-user/{userId}', [PendingUserController::class, 'rejectUser'])->name('reject-user');
    Route::get('users/approved-users', [PendingUserController::class, 'showApprovedUsers'])->name('approved-users');
    Route::post('users/unapprove-user/{userId}', [PendingUserController::class, 'unapproveUser'])->name('unapprove-user');
    Route::put('change-password/{userId}', [PendingUserController::class, 'changePassword'])->name('change-password');

    Route::get('reports', [ReportsController::class, 'showCompletedTasks'])->name('reports');
    Route::get('reports/export', [ReportsController::class, 'exportCSV'])->name('reports.export');

    Route::prefix('trash')->name('trash.')->group(function () {
        Route::get('/', [TrashController::class, 'index'])->name('index');
        Route::delete('/{id}', [TrashController::class, 'destroy'])->name('destroy');
        Route::delete('/delete-all', [TrashController::class, 'deleteAll'])->name('deleteAll');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.settings.index');
        Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
        Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::get('/password', [ProfileController::class, 'showPassword'])->name('password');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
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
        Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('user.tasks.show');
        Route::post('/tasks/{task}/comments', [TaskController::class, 'storeComment'])->name('comments.store');
        Route::put('/notifications/mark-as-read/{id}', [TaskController::class, 'markAsRead'])->name('notifications.markAsRead');
        Route::get('/activity/{id}/read', [TaskController::class, 'markActivityAsRead'])->name('tasks.markActivityAsRead');

        

    });

   
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('index'); 
        Route::get('/{id}', [MessageController::class, 'show'])->name('show');
        Route::post('/submit', [MessageController::class, 'store'])->name('submit'); 
    });


    Route::get('/dashboard', [DashboardController::class, 'dynamicTasks'])->name('dashboard');
});

Route::prefix('user')->name('user.')->middleware(['auth', 'user'])->group(function () {

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [ProfilesController::class, 'index'])->name('index');
        Route::get('/profile', [ProfilesController::class, 'showProfile'])->name('profile');
        Route::post('/profile', [ProfilesController::class, 'updateProfile'])->name('profile.update');
        Route::get('/password', [ProfilesController::class, 'showPasswordForm'])->name('password');
        Route::put('/password', [ProfilesController::class, 'updatePassword'])->name('password.update');
    });
    
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/all-tasks', [TasksController::class, 'index'])->name('index'); 
        Route::get('/to-do', [TasksController::class, 'todo'])->name('to-do');
        Route::get('/in-progress', [TasksController::class, 'inprogress'])->name('in-progress');
        Route::get('/completed', [TasksController::class, 'completed'])->name('completed');
        
        // For User Task Details
        Route::get('/user/tasks/{task}', [TasksController::class, 'showForUser'])->name('user.tasks.show');

        Route::post('/tasks/{task}/comments', [TasksController::class, 'storeComments'])->name('comments.stores');
        
        // Route to assign task to a user
        Route::post('/assign/{taskId}', [TasksController::class, 'assignTaskToUser'])->name('assign');
        
        // Add the Start Now functionality
        Route::get('/start/{task}', [TasksController::class, 'startTask'])->name('start');

        // Add the Complete functionality
        Route::get('/complete/{task}', [TasksController::class, 'completeTask'])->name('complete');
    });

    // Route to mark notification as read
    Route::get('/notifications/{id}/read', [TasksController::class, 'markAsRead'])->name('notifications.read');
    
    // Updated dashboard route
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});



Route::get('/', fn() => view('landing_page.index'))->name('home');
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/login/id-number', fn() => view('auth.login2'))->name('login2');
Route::post('/login', [AuthController::class, 'checkLogin'])->name('checkLogin');
Route::post('/login/id-number', [IdNumberAuthController::class, 'loginWithId'])->name('loginWithId');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Message
Route::get('admin/message-reply', fn() => view('admin.message-reply'))->name('message-reply');
Route::get('admin/task-view', fn() => view('admin.task-view'))->name('task-view');
