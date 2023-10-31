<?php

use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TaskStateController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\UserProjectsController;
use App\Http\Controllers\ProjectUserRoleController;
use App\Mail\OrderEmail;

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

route::get('products/{product}/show', [ProductController::class, 'show'])->name('products.show');
route::get('/', [ArticleController::class, 'index'])->name('index');
Route::get('/testroute', function () {
    $name = "Funny Coder";

    // The email sending is done using the to method on the Mail facade
    Mail::to('testreceiver@gmail.com')->send(new OrderEmail($name));
});
Route::prefix('products')->name('products.')->group(function () {
    route::get('', [ProductController::class, 'index'])->name('index');
    route::get('{product}/show', [ProductController::class, 'show'])->name('show');

    Route::prefix('cart')->name('cart')->group(function () {
        route::get('{product}/add', [CartController::class, 'add'])->name('.add');
        route::get('{product}/subtract', [CartController::class, 'subtract'])->name('.subtract');
        route::get('{product}/delete', [CartController::class, 'delete'])->name('.delete');
        route::get('order', [OrderController::class, 'order'])->name('.order');
        route::post('order/confirm', [OrderController::class, 'orderConfirm'])->name('.order.confirm');
        route::get('checkout', [OrderController::class, 'checkout'])->name('.checkout');
        route::get('', [CartController::class, 'show'])->name('');
    });

    Route::prefix('orders')->name('orders')->group(function () {
        route::get('store', [OrderController::class, 'store'])->name('.store');
        route::get('{order}/products', [OrderController::class, 'store'])->name('.');
        route::get('{order}/info', [OrderController::class, 'store'])->name('.');

        route::get('', [OrderController::class, 'show'])->name('');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('user')->name('user')->group(function () {
        Route::prefix('projects')->name('.projects')->group(function () {
            Route::get('index', [UserProjectsController::class, 'index'])->name('.index');
            Route::get('{project}', [UserProjectsController::class, 'show'])->name('.show');
            Route::get('{project}/tasks', [UserProjectsController::class, 'showTasks'])->name('.tasks');
            Route::get('{project}/tasks/{task}', [UserProjectsController::class, 'showTask'])->name('.tasks.show');
        });

        Route::prefix('orders')->name('.orders')->group(function () {
            Route::prefix('{order}/show')->name('.show')->group(function () {
                Route::get('', [OrderController::class, 'show'])->name('');
                Route::get('/download-pdf', [OrderController::class, 'downloadPdf'])->name('.pdf');
                Route::get('products', [OrderController::class, 'showProducts'])->name('.products');
            });
            Route::get('own', [OrderController::class, 'own'])->name('.own');
        });
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::prefix('categories')->name('categories')->group(function () {
            Route::get('create', [CategoryController::class, 'create'])->name('.create');
            Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('.edit');
            Route::post('{category}/update', [CategoryController::class, 'update'])->name('.update');
            Route::post('create', [CategoryController::class, 'store'])->name('.store');
            Route::get('{category}/delete', [CategoryController::class, 'delete'])->name('.delete');
            Route::get('', [CategoryController::class, 'dashboard'])->name('');
            Route::get('search', [CategoryController::class, 'search'])->name('.search');
        });

        Route::prefix('orders')->name('orders')->group(function () {
            Route::get('create', [OrderController::class, 'create'])->name('.create');
            Route::get('{order}/edit', [OrderController::class, 'edit'])->name('.edit');
            Route::get('{order}/edit/products', [OrderProductController::class, 'edit'])->name('.edit.products');
            Route::post('{order}/edit/products/store', [OrderProductController::class, 'store'])->name('.products.store');
            Route::get('{order}/edit/products/{product}/add', [OrderProductController::class, 'add'])->name('.products.add');
            Route::get('{order}/edit/products/{product}/subtract', [OrderProductController::class, 'subtract'])->name('.products.subtract');
            Route::get('{order}/edit/products/{product}/delete', [OrderProductController::class, 'delete'])->name('.products.delete');
            Route::post('{order}/update', [OrderController::class, 'update'])->name('.update');
            Route::post('create', [OrderController::class, 'store'])->name('.store');
            Route::get('{order}/delete', [OrderController::class, 'delete'])->name('.delete');
            Route::get('', [OrderController::class, 'dashboard'])->name('');
            Route::get('search', [OrderController::class, 'search'])->name('.search');
        });

        Route::prefix('roles')->name('roles')->group(function () {
            Route::get('create', [RoleController::class, 'create'])->name('.create');
            Route::get('{role}/edit', [RoleController::class, 'edit'])->name('.edit');
            Route::post('{role}/update', [RoleController::class, 'update'])->name('.update');
            Route::post('create', [RoleController::class, 'store'])->name('.store');
            Route::get('{role}/delete', [RoleController::class, 'delete'])->name('.delete');
            Route::get('', [RoleController::class, 'dashboard'])->name('');
            Route::get('search', [RoleController::class, 'search'])->name('.search');
        });

        Route::prefix('articles')->name('articles')->group(function () {
            Route::get('create', [ArticleController::class, 'create'])->name('.create');
            Route::post('create', [ArticleController::class, 'store'])->name('.store');
            Route::get('{article}/edit', [ArticleController::class, 'edit'])->name('.edit');
            Route::post('{article}/update', [ArticleController::class, 'update'])->name('.update');
            Route::get('{article}/delete', [ArticleController::class, 'delete'])->name('.delete');
            Route::get('', [ArticleController::class, 'dashboard'])->name('');
            Route::get('search', [ArticleController::class, 'search'])->name('.search');
        });

        Route::prefix('projects')->name('projects')->group(function () {
            Route::get('create', [ProjectController::class, 'create'])->name('.create');
            Route::post('create', [ProjectController::class, 'store'])->name('.store');
            Route::get('{project}/edit', [ProjectController::class, 'edit'])->name('.edit');
            Route::post('{project}/update', [ProjectController::class, 'update'])->name('.update');
            Route::get('{project}/delete', [ProjectController::class, 'delete'])->name('.delete');
            Route::get('', [ProjectController::class, 'dashboard'])->name('');
            Route::get('search', [ProjectController::class, 'search'])->name('.search');



            Route::prefix('{id}/edit/roles')->name('.roles')->group(function () {
                Route::get('{role}/delete', [ProjectUserRoleController::class, 'delete'])->name('.delete');
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
            Route::get('{state}/edit', [TaskStateController::class, 'edit'])->name('.edit');
            Route::post('{state}/edit', [TaskStateController::class, 'update'])->name('.update');
            Route::get('{state}/delete', [TaskStateController::class, 'delete'])->name('.delete');
        });

        Route::prefix('products')->name('products')->group(function () {
            Route::get('', [ProductController::class, 'dashboard'])->name('');
            Route::get('create', [ProductController::class, 'create'])->name('.create');
            Route::post('store', [ProductController::class, 'store'])->name('.store');
            Route::get('search', [ProductController::class, 'search'])->name('.search');
            Route::get('{product}/edit', [ProductController::class, 'edit'])->name('.edit');
            Route::post('{product}/update', [ProductController::class, 'update'])->name('.update');
            Route::get('{product}/delete', [ProductController::class, 'delete'])->name('.delete');
        });

        Route::prefix('properties')->name('properties')->group(function () {
            Route::get('', [PropertyController::class, 'dashboard'])->name('');
            Route::get('create', [PropertyController::class, 'create'])->name('.create');
            Route::post('store', [PropertyController::class, 'store'])->name('.store');
            Route::get('search', [PropertyController::class, 'search'])->name('.search');
            Route::get('{property}/edit', [PropertyController::class, 'edit'])->name('.edit');
            Route::post('{property}/edit', [PropertyController::class, 'update'])->name('.update');
            Route::get('{property}/delete', [PropertyController::class, 'delete'])->name('.delete');
        });
    });
});


require __DIR__ . '/auth.php';
