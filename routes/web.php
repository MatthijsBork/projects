<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TaskStateController;
use App\Http\Controllers\UserProjectsController;
use App\Http\Controllers\ProjectUserRoleController;

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
Route::get('articles/{id}/show', [ArticleController::class, 'show'])->name('articles.show');
route::get('/', [ArticleController::class, 'index'])->name('index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::prefix('categories')->name('categories')->group(function () {
            Route::get('create', [CategoryController::class, 'create'])->name('.create');
            Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('.edit');
            Route::post('{id}/edit', [CategoryController::class, 'update'])->name('.update');
            Route::post('create', [CategoryController::class, 'store'])->name('.store');
            Route::get('{id}/delete', [CategoryController::class, 'delete'])->name('.delete');
            Route::get('', [CategoryController::class, 'dashboard'])->name('');
            Route::get('search', [CategoryController::class, 'search'])->name('.search');
        });

        Route::prefix('roles')->name('roles')->group(function () {
            Route::get('create', [RoleController::class, 'create'])->name('.create');
            Route::get('{id}/edit', [RoleController::class, 'edit'])->name('.edit');
            Route::post('{id}/edit', [RoleController::class, 'update'])->name('.update');
            Route::post('create', [RoleController::class, 'store'])->name('.store');
            Route::get('{id}/delete', [CategoryController::class, 'delete'])->name('.delete');
            Route::get('', [RoleController::class, 'dashboard'])->name('');
            Route::get('search', [RoleController::class, 'search'])->name('.search');
        });

        Route::prefix('articles')->name('articles')->group(function () {
            Route::get('create', [ArticleController::class, 'create'])->name('.create');
            Route::post('create', [ArticleController::class, 'store'])->name('.store');
            Route::get('{id}/edit', [ArticleController::class, 'edit'])->name('.edit');
            Route::post('{id}/delete', [ArticleController::class, 'update'])->name('.update');
            Route::get('{id}/delete', [ArticleController::class, 'delete'])->name('.delete');
            Route::get('', [ArticleController::class, 'dashboard'])->name('');
            Route::get('search', [ArticleController::class, 'search'])->name('.search');
        });

        Route::prefix('projects')->name('projects')->group(function () {
            Route::get('create', [ProjectController::class, 'create'])->name('.create');
            Route::post('create', [ProjectController::class, 'store'])->name('.store');
            Route::get('{id}/edit', [ProjectController::class, 'edit'])->name('.edit');
            Route::post('{id}/edit', [ProjectController::class, 'update'])->name('.update');
            Route::get('{id}/delete', [ProjectController::class, 'delete'])->name('.delete');
            Route::get('', [ProjectController::class, 'dashboard'])->name('');
            Route::get('search', [ProjectController::class, 'search'])->name('.search');

            Route::prefix('user')->name('.user')->group(function () {
                Route::get('user', [UserProjectsController::class, 'dashboard'])->name('');
                Route::get('{project}/show', [UserProjectsController::class, 'show'])->name('.show');
                Route::get('{project}/show/tasks', [UserProjectsController::class, 'showTasks'])->name('.show.tasks');
            });

            Route::prefix('{id}/edit/roles')->name('.roles')->group(function () {
                Route::get('{roleid}/delete', [ProjectUserRoleController::class, 'delete'])->name('.delete');
                Route::get('', [ProjectUserRoleController::class, 'edit'])->name('');
                Route::post('', [ProjectUserRoleController::class, 'store'])->name('.store');
            });

            Route::prefix('{id}/edit/tasks')->name('.tasks')->group(function () {
                Route::get('', [TaskController::class, 'dashboard'])->name('');
                Route::get('{taskid}/delete', [TaskController::class, 'delete'])->name('.delete');
                Route::get('{taskid}/edit', [TaskController::class, 'edit'])->name('.edit');
                Route::post('{task}/update', [TaskController::class, 'update'])->name('.update');
                Route::get('create', [TaskController::class, 'create'])->name('.create');
                Route::post('create', [TaskController::class, 'store'])->name('.store');
            });
        });

        Route::prefix('states')->name('states')->group(function () {
            Route::get('', [TaskStateController::class, 'dashboard'])->name('');
            Route::get('create', [TaskStateController::class, 'create'])->name('.create');
            Route::post('store', [TaskStateController::class, 'store'])->name('.store');
            Route::get('{id}/edit', [TaskStateController::class, 'edit'])->name('.edit');
            Route::post('{id}/edit', [TaskStateController::class, 'update'])->name('.edit');
            Route::get('{id}/delete', [TaskStateController::class, 'delete'])->name('.delete');
        });

        Route::prefix('products')->name('products')->group(function () {
            Route::get('', [ProductController::class, 'dashboard'])->name('');
            Route::get('create', [ProductController::class, 'create'])->name('.create');
            Route::post('store', [ProductController::class, 'store'])->name('.store');
            Route::get('search', [ProductController::class, 'search'])->name('.search');
            Route::get('{id}/edit', [ProductController::class, 'edit'])->name('.edit');
            Route::put('{product}/update', [ProductController::class, 'update'])->name('.update');
            Route::get('{id}/delete', [ProductController::class, 'delete'])->name('.delete');
        });

        Route::prefix('properties')->name('properties')->group(function () {
            Route::get('', [PropertyController::class, 'dashboard'])->name('');
            Route::get('create', [PropertyController::class, 'create'])->name('.create');
            Route::post('store', [PropertyController::class, 'store'])->name('.store');
            Route::get('search', [PropertyController::class, 'search'])->name('.search');
            Route::get('{id}/edit', [PropertyController::class, 'edit'])->name('.edit');
            Route::post('{id}/edit', [PropertyController::class, 'update'])->name('.edit');
            Route::get('{id}/delete', [PropertyController::class, 'delete'])->name('.delete');
        });
    });
});


require __DIR__ . '/auth.php';
