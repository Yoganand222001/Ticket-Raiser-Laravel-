<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\LabelController;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'openTicketCount'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    /*Ticket CRUD*/
    Route::get('/Tickets/{filters?}', [TicketController::class, 'index'])->name('tickets.index');
    Route::resource('ticket', TicketController::class);
    Route::get('/files/{id}', [TicketController::class, 'download'])->name('files.download');

    /* Profile CRUD */
    Route::group(['prefix' => 'profile' ], function (){
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    /*Category CRUD*/
    Route::group(['prefix' => 'categories', 'middleware' => 'role:Admin'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.create');
        Route::put('/edit', [CategoryController::class, 'update'])->name('category.edit');
        Route::delete('/delete', [CategoryController::class, 'destroy'])->name('category.delete');
    });

    /*Label CRUD*/
    Route::group(['prefix' => 'labels', 'middleware' => 'role:Admin'], function () {
        Route::get('/', [LabelController::class, 'index'])->name('labels');
        Route::post('/store', [LabelController::class, 'store'])->name('label.create');
        Route::put('/edit', [LabelController::class, 'update'])->name('label.edit');
        Route::delete('/delete', [LabelController::class, 'destroy'])->name('label.delete');
    });

    /*User CRUD*/
    Route::group(['middleware' => 'role:Admin'], function (){
        Route::get('/users/{role?}', [UserController::class, 'index'])->name('users.index');
        Route::resource('user', UserController::class);
    });

    /*comments*/
    Route::group(['prefix' => 'comments'], function (){
        Route::get('/create/{id}',[CommentController::class, 'create'])->name('comments.create');
        Route::post('/store/{id}',[CommentController::class, 'store'])->name('comments.store');
    });

    /*logging activity*/
    Route::get('/ticket-logs/{data?}', [LogsController::class, 'activityLogs'])->name('logs')->middleware('role:Admin');
});

require __DIR__ . '/auth.php';
