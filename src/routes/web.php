<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Todo2Controller;
use App\Http\Controllers\CategoryController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [Todo2Controller::class, 'index']);
Route::post('/todos', [Todo2Controller::class, 'store']);
Route::patch('/todos/update', [Todo2Controller::class, 'update']);
Route::delete('/todos/delete', [Todo2Controller::class, 'delete']);
Route::get('/category', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::patch('/categories/update', [CategoryController::class, 'update']);
Route::delete('/categories/delete', [CategoryController::class, 'delete']);
Route::get('/todos/search', [Todo2Controller::class, 'search']);

