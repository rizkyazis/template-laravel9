<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['role:Admin'])->group(function () {
    Route::prefix('user')->group(function (){
        Route::get('',[UserController::class, 'list'])->name('admin.user.list');
        Route::get('{id}/update',[UserController::class, 'updatePage'])->name('admin.user.update.page');
        Route::patch('{id}/update',[UserController::class, 'update'])->name('admin.user.update');
        Route::delete('{id}/delete',[UserController::class, 'delete'])->name('admin.user.delete');

        Route::prefix('role')->group(function (){
            Route::post('{idUser}',[UserController::class, 'addRole'])->name('admin.user.role.add');
            Route::delete('{idUser}/{idRole}',[UserController::class, 'deleteRole'])->name('admin.user.role.delete');
        });
    });
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
})->name('admin');

require __DIR__ . '/auth.php';
