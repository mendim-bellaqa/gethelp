<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/notes', function () {
    return view('notes.home');
});

Route::get('/aktivitetet', [TaskController::class, 'index'])->name('dashboard');
Route::get('/create-task', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register']);

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

});

Route::prefix('tasks')->group(function () {
    Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


