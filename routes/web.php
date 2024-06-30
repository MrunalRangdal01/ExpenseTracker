<?php

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Category
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'showCategory'])->name('category');
Route::post('/add-category', [App\Http\Controllers\CategoryController::class, 'addCategory'])->name('add_category');
Route::post('/update-category', [App\Http\Controllers\CategoryController::class, 'updateCategory'])->name('update_category');
Route::get('/delete-category/{id}', [App\Http\Controllers\CategoryController::class, 'deleteCategory'])->name('delete_category');

// Expenses 
Route::get('/expense', [App\Http\Controllers\ExpenseController::class, 'showExpense'])->name('expense');
Route::post('/add-expense', [App\Http\Controllers\ExpenseController::class, 'addExpense'])->name('add_expense');
Route::post('/update-expense', [App\Http\Controllers\ExpenseController::class, 'updateExpense'])->name('update_expense');
Route::get('/delete-expense/{id}', [App\Http\Controllers\ExpenseController::class, 'deleteExpense'])->name('delete_expense');