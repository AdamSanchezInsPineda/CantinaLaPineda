<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\ProductController as PublicProductController;
use App\Http\Controllers\Public\CategoryController as PublicCategoryController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PreferenceController;

Route::get('/', [PublicProductController::class, 'index'])->name('product.index');

Route::resource('product', PublicProductController::class)->only(['show']);

Route::get('/category/{category_name}', [PublicCategoryController::class, 'show'])->name('category.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
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
    Route::resource('order', OrderController::class);
    Route::resource('preference', PreferenceController::class);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

require __DIR__.'/auth.php';
