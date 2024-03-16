<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\Post\PostCommentController;
use App\Http\Controllers\Api\Post\PostController;
use App\Http\Controllers\Api\Post\PostLikeController;
use App\Http\Controllers\Api\Post\PostShareController;
use App\Http\Controllers\Api\Profile\EditProfileController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\Reel\ReelCommentController;
use App\Http\Controllers\Api\Reel\ReelController;
use App\Http\Controllers\Api\Reel\ReelLikeController;
use App\Http\Controllers\Api\Reel\ReelShareController;
use App\Http\Controllers\Api\SearchController;
use Illuminate\Support\Facades\Route;


Route::get('auth-failed', function () {
    return response('unauthenticated', 401);
})->name('authFailed');



Route::group(['as' => 'api.'], function () {
    // Auth Routes
    Route::group(['as' => 'auth.', 'prefix' => 'auth'], function () {
        // Login Route
        Route::post("/login", [LoginController::class, "login"]);

        // Register Routes
        Route::post("/register", [RegisterController::class, "register"]);
        Route::post("/add_info", [RegisterController::class, "addInfo"])
            ->middleware("auth:api");

        // Verify OTP Route
        Route::post("/verify_otp", [AuthController::class, "verifyOtp"]);

        Route::group(["middleware" => "auth:api"], function () {
            Route::get("/user", [AuthController::class, "user"]);
            Route::get("/user/{id}", [AuthController::class, "getUser"]);
            Route::get("/all_users", [AuthController::class, "allUsers"]);
            Route::get("/logout", [AuthController::class, "logout"]);
        });
    });


    // Main Routes
    Route::group(["middleware" => "auth:api"], function () {
        // Edit Profile Route
        Route::post("/edit_profile", [EditProfileController::class, "update"]);

        // Profile Route
        Route::get("/profile", [ProfileController::class, "profile"]);

        // Post CRUD
        Route::get("/posts", [PostController::class, "index"]);
        Route::get("/posts/{id}", [PostController::class, "get"]);
        Route::post("/post", [PostController::class, "store"]);
        // Post Like and Dislike
        Route::get("/like_post/{id}", [PostLikeController::class, "store"]);
        Route::get("/unlike_post/{id}", [PostLikeController::class, "destroy"]);
        // Post Comment
        Route::get("/post_comments/{id}", [PostCommentController::class, "get"]);
        Route::post("/post_comment/{id}", [PostCommentController::class, "store"]);
        // Post Share
        Route::get("/share_post/{id}", [PostShareController::class, "store"]);
        Route::delete("/delete_shared_post/{id}", [PostShareController::class, "destroy"]);

        Route::get("/has_liked_post/{id}", [PostController::class, "hasLiked"]);
        Route::get("/post_total_likes/{id}", [PostController::class, "totalLikes"]);
        Route::get("/post_total_comments/{id}", [PostController::class, "totalComments"]);
        Route::get("/post_total_shares/{id}", [PostController::class, "totalShares"]);


        // Reel CRUD
        Route::get("/reels", [ReelController::class, "index"]);
        Route::get("/reels/{id}", [ReelController::class, "get"]);
        Route::post("/reel", [ReelController::class, "store"]);
        // Post Like and Dislike
        Route::get("/like_reel/{id}", [ReelLikeController::class, "store"]);
        Route::get("/unlike_reel/{id}", [ReelLikeController::class, "destroy"]);
        // Post Comment
        Route::get("/reel_comments/{id}", [ReelCommentController::class, "get"]);
        Route::post("/reel_comment/{id}", [ReelCommentController::class, "store"]);
        // Reel Share
        Route::get("/share_reel/{id}", [ReelShareController::class, "store"]);
        Route::delete("/delete_shared_reel/{id}", [ReelShareController::class, "destroy"]);

        Route::get("/has_liked_reel/{id}", [ReelController::class, "hasLiked"]);
        Route::get("/reel_total_likes/{id}", [ReelController::class, "totalLikes"]);
        Route::get("/reel_total_comments/{id}", [ReelController::class, "totalComments"]);
        Route::get("/reel_total_shares/{id}", [ReelController::class, "totalShares"]);


        // Follow and Following
        Route::get("followers/{id}", [FollowController::class, "followers"]);
        Route::get("followings/{id}", [FollowController::class, "followings"]);
        Route::get("follow/{to}", [FollowController::class, "follow"]);
        Route::get("unfollow/{to}", [FollowController::class, "unFollow"]);


        // Search Route
        Route::get("/search", [SearchController::class, "search"]);
    });
});
