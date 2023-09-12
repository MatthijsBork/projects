<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

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


app()->setLocale('nl');

route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/show/{id}', [ArticleController::class, 'show'])->name('articles.show');
route::get('/', [ArticleController::class, 'index'])->name('index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/articles')->group(function () {
        Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/create', [ArticleController::class, 'post'])->name('articles.post');
        Route::get('/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::post('/edit/{id}', [ArticleController::class, 'edit'])->name('articles.update');
        Route::get('/delete/{id}', [ArticleController::class, 'delete'])->name('articles.delete');
        Route::get('/dashboard', [ArticleController::class, 'dashboard'])->name('articles.dashboard');
    });
    Route::prefix('/categories')->group(function () {
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/edit{id}', [CategoryController::class, 'edit'])->name('categories.update');
        Route::post('/create', [CategoryController::class, 'post'])->name('categories.post');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        Route::get('/dashboard', [CategoryController::class, 'dashboard'])->name('categories.dashboard');
    });
});

require __DIR__ . '/auth.php';
