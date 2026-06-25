<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::get('/admin', [AuthController::class, 'showLogin'])->name('admin.index');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/register', [AuthController::class, 'showRegister'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'register'])->name('admin.register.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

Route::prefix('admin')->middleware('auth')->group(function () {

    // About: index/edit/update
    Route::get('about', [AboutController::class, 'index'])->name('about.index');
    Route::get('about/{about}/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about/{about}', [AboutController::class, 'update'])->name('about.update');

    // Products (resource)
    Route::resource('products', ProductController::class);

    // Testimonials
    Route::resource('testimonials', TestimonialController::class);
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product}', [HomeController::class, 'show'])->name('product.show');
use App\Http\Controllers\ChatbotController;

Route::post('/chatbot', [ChatbotController::class, 'chat']);

Route::get('/chat', function() {
    return view('chat');
});
