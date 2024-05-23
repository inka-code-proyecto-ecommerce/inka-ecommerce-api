<?php

use App\Http\Controllers\Admin\Product\CategoryController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Product\AttributeProductController;


Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/verified_auth', [AuthController::class, 'verified_auth'])->name('verified-auth');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login_tienda', [AuthController::class, 'login_tienda'])->name('login-tienda');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->name('me');
    //
    Route::post('/verified_email', [AuthController::class, 'verified_email'])->name('verified-email');
    Route::post('/verified_code', [AuthController::class, 'verified_code'])->name('verified-code');
    Route::post('/new_password', [AuthController::class, 'new_password'])->name('new-password');
});

Route::group([
    "middleware" => "auth:api",
    "prefix" => "admin",
], function ($router) {
    Route::get("categories/config", [CategoryController::class, "config"]);
    Route::resource("categories", CategoryController::class);
    Route::post("categories/{id}", [CategoryController::class, "update"]);

    Route::post("properties", [CategoryController::class, "store_propertie"]);
    Route::delete("properties/{id}", [CategoryController::class, "destroy_propertie"]);
    Route::resource("attributes", AttributeProductController::class);

    Route::resource("sliders", SliderController::class);
    Route::post("sliders/{id}", [SliderController::class, "update"]);
});
