<?php

use App\Http\Controllers\BookStore\BookStoreController;
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

Route::get('/', [BookStoreController::class, 'index']);


Route::prefix("book-store")
    ->controller(BookStoreController::class)
    ->group(function () {
        Route::get("/index", "index")->name("index");
        Route::get("/delete/{id}", "delete")->name("delete");
        Route::post("/store", "store")->name("store");
        Route::get("/edit/{id}", "edit")->name("edit");
        Route::post("/update/{id}", "update")->name("update");
    });