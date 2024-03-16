<?php


use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['as' => 'admin.'], function () {
// Admin Auth Routes
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get("/sign_in", [LoginController::class, "index"])->name("signInView");
        Route::get("/logout", [AuthController::class, "logout"])->name("logout")->middleware("auth:admin");
    });

    // Main Routes with Middleware
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");

        // Posts Routes
        Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
            Route::get("/", [PostController::class, "index"])->name("index");
        });

        // Users Routes
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get("/", [UserController::class, "index"])->name("index");
        });
    });
});
