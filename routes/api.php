<?php

use App\Http\Controllers\api\AuthorController;
use App\Http\Controllers\Api\BooksController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\TestingController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('books', [BooksController::class, 'index']);
Route::post('books/create', [BooksController::class, 'store']);
Route::put('books/update/{id}', [BooksController::class, 'update']);
Route::delete('books/delete/{id}', [BooksController::class, 'destroy']);

Route::get('author', [AuthorController::class, 'index']);
Route::post('author/create', [AuthorController::class, 'store']);
Route::put('author/update/{id}', [AuthorController::class, 'update']);
Route::get('author', [AuthorController::class, 'destroy']);

Route::get('category',[CategoryController::class, 'index']);
Route::post('category/create', [CategoryController::class, 'store']);
Route::get('author', [AuthorController::class, 'index']);
Route::get('author', [AuthorController::class, 'index']);

Route::get('testing', [TestingController::class, 'index']);

Route::post('login', [LoginController::class, '__invoke']);
Route::post('logout', [LogoutController::class, '__invoke']);


Route::middleware('auth:api')->get('datauser', function (Request $request) {
    return $request->user();
});