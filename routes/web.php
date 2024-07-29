<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobsController;
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
    return view('view-user.landing-page');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard-admin.index');
    })->name('dashboard');
    Route::get('job-opportunities', [JobsController::class, 'jobIndex']);
    Route::get('job/create', [JobsController::class, 'addJob']);
    Route::post('job/store', [JobsController::class, 'jobStore']);
    Route::get('job/get/{id}', [JobsController::class, 'getJob']);
    Route::post('job/store/{id}', [JobsController::class, 'jobStore']);
});

require __DIR__.'/auth.php';
