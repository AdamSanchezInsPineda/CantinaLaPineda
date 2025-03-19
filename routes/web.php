<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\ProductController as PublicProductController;
use App\Http\Controllers\Public\CategoryController as PublicCategoryController;
use App\Http\Controllers\Public\OrderController as PublicOrderController;
use App\Http\Controllers\Public\UserController as PublicUserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PreferenceController as AdminPreferenceController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

Route::get('/', [PublicProductController::class, 'index'])->name('product.index');

Route::resource('product', PublicProductController::class)->only(['show']);
Route::resource('user', PublicUserController::class)->only(['show']);
Route::resource('order', PublicOrderController::class)->only(['show']);

Route::get('/category/{category_name}', [PublicCategoryController::class, 'show'])->name('category.show');

Route::get('/products/version', [PublicProductController::class, 'getProductsVersion']);
Route::get('/products/all', [PublicProductController::class, 'getProducts']);

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [PublicOrderController::class, 'create'])->name('order.summary');
    Route::post('/checkout/new', [PublicOrderController::class, 'store'])->name('order.checkout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('dashboard');
    Route::resource('category', AdminCategoryController::class);
    Route::resource('product', AdminProductController::class);
    Route::resource('order', AdminOrderController::class);
    Route::resource('preference', AdminPreferenceController::class);
    Route::resource('user', AdminUserController::class);
    Route::get('/api/monthly-sales', [AdminOrderController::class, 'getMonthlySales']);
    Route::get('/category/parameters/{id}', [AdminCategoryController::class, 'listParameters'])->name('category.parameters');
    Route::get('/category/parameters/{id}/create', [AdminCategoryController::class, 'createParameters'])->name('category.parameters.create');
    Route::post('/category/parameters/{id}/store', [AdminCategoryController::class, 'storeParameters'])->name('category.parameters.store');
    Route::post('/category/parameters/{id}/destroy', [AdminCategoryController::class, 'disableParameters'])->name('category.parameters.destroy');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

require __DIR__.'/auth.php';
