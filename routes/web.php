<?php

use App\Http\Controllers\Admins\AdminController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\Admins\AdminDashboardController;
use App\Http\Controllers\Admins\RoleController;
use App\Http\Controllers\Admins\UserController;

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


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/formations',[FormationController::class,'index'])->name('formations.index');

Route::group(['auth:sanctum', 'verified'], function(){
    Route::get('/formation/{id}',[FormationController::class,'show'])->name('formations.show');
    Route::get('/formation/edit/{id}',[FormationController::class,'edit'])->name('formations.edit');
    Route::patch('/formation/{id}',[FormationController::class,'update'])->name('formations.update');
    Route::post('toggleProgress',[FormationController::class,'toggleProgress'])->name('formations.toggle');
    Route::post('/formations',[FormationController::class,'store'])->name('dashboard');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::prefix('admin')->middleware(['auth:sanctum','verified'])->name('admin.')->group(function(){
    Route::get('dashboard', [AdminDashboardController::class,'index'])->name('dashboard');

    Route::resource('roles',RoleController::class);
    Route::resource('admins',AdminController::class)->parameters([
        'admins' => 'user'])->only('index','show','update');
    Route::resource('users',UserController::class)->only('index','show','update');


});



