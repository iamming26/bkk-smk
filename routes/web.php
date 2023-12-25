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

// Route::get('/', function () {
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/apply', [\App\Http\Controllers\JobController::class, 'apply'])->name('apply');

/**USER */
Route::middleware(['auth', 'user-access:user'])->group(function(){
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/history', [\App\Http\Controllers\User\HistoryController::class, 'history'])->name('history');
        Route::post('/delete', [\App\Http\Controllers\User\HistoryController::class, 'delete'])->name('delete');
    });
});

/**ADMIN */
Route::middleware(['auth', 'user-access:admin'])->group(function(){
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/{id}', [\App\Http\Controllers\Admin\DashboardController::class, 'detail'])->name('dashboard.detail');

        Route::resource('/job', \App\Http\Controllers\Admin\JobController::class);
        // Route::get('/history', [\App\Http\Controllers\User\HistoryController::class, 'history'])->name('history');
        // Route::post('/delete', [\App\Http\Controllers\User\HistoryController::class, 'delete'])->name('delete');
    });
});