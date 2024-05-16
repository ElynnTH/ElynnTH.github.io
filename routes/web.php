<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'tickets/', 'as' => 'tickets.',], function () {

    //Route::get('/{ticket}', [TicketController::class, 'show'])->name('show');

    Route::group(['middleware' => ['auth']], function () {

        //Route::post('', [TicketController::class, 'store'])->name('store');

        //Route::get('/{ticket}/edit', [TicketController::class, 'edit'])->name('edit');

        //Route::put('/{ticket}', [TicketController::class, 'update'])->name('update');

        //Route::delete('/{idticket}', [TicketController::class, 'destroy'])->name('destroy');

        //Route::post('/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');
    });
});
Route::resource('tickets',TicketController::class)->except(['index','create','show'])->middleware('auth');

Route::resource('tickets',TicketController::class)->only(['show']);

Route::resource('tickets.comments',CommentController::class)->only(['store'])->middleware('auth');

Route::resource('users',UserController::class)->only('show');
Route::resource('users',UserController::class)->only('edit','update')->middleware('auth');

Route::get('profile',[UserController::class,'profile'])->middleware('auth')->name('profile');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');


Route::middleware(['auth','can:admin'])->prefix('/admin')->as('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users',AdminUserController::class)->only('index');

    Route::resource('tickets',AdminTicketController::class)->only('index');
});

