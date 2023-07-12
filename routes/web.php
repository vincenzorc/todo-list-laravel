<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;
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
    return view('welcome');
});

Route::get('/todos', [TodoController::class, 'index'])->name('todos');
Route::post('/todos', [TodoController::class, 'store'])->name('todos');
Route::get('/todos/{id}', [TodoController::class, 'show'])->name('todos-show');
Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos-update');
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos-destroy');

Route::resource('categories', CategoryController::class);