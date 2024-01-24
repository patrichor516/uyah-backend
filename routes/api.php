<?php

use App\Http\Controllers\api\AuthorController;
use App\Http\Controllers\Api\BooksController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\PeminjamanController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\TestingController;
use App\Models\Author;
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
Route::get('books/{id}', [BooksController::class, 'show']);
Route::get('booksjhhuuh', [BooksController::class, 'book']);
Route::post('books/create', [BooksController::class, 'create']);
Route::post('books/create/all', [BooksController::class, 'store']);
Route::put('books/update/{id}', [BooksController::class, 'update']);
Route::delete('books/delete/{id}', [BooksController::class, 'destroy']);

Route::get('author', [AuthorController::class, 'index']);
Route::get('author/{id}', [AuthorController::class, 'show']);
Route::post('author/create', [AuthorController::class, 'store']);
Route::put('author/update/{id}', [AuthorController::class, 'update']);
Route::delete('author/delete/{id}', [AuthorController::class, 'destroy']);

Route::get('category',[CategoryController::class, 'index']);
Route::get('category/{id}',[CategoryController::class, 'show']);
Route::post('category/create', [CategoryController::class, 'store']);
Route::put('category/update/{id}', [CategoryController::class, 'update']);
Route::delete('category/delete/{id}', [CategoryController::class, 'destroy']);

Route::get('anggota',[UserController::class, 'index']);
Route::post('anggota/create', [UserController::class, 'store']);
Route::get('anggota/{id}',[UserController::class, 'show']);
Route::put('anggota/update/{id}', [UserController::class, 'update']);
Route::delete('anggota/delete/{id}', [UserController::class, 'destroy']);

Route::get('peminjaman',[PeminjamanController::class, 'index']);
Route::post('peminjaman/create', [PeminjamanController::class, 'create']);
Route::get('anggota/{id}',[UserController::class, 'show']);
Route::put('anggota/update/{id}', [UserController::class, 'update']);
Route::delete('anggota/delete/{id}', [UserController::class, 'destroy']);

Route::get('testing', [TestingController::class, 'index']);

Route::post('login', [LoginController::class, '__invoke']);
Route::post('logout', [LogoutController::class, '__invoke']);


Route::middleware('auth:api')->get('datauser', function (Request $request) {
    return $request->user();
});