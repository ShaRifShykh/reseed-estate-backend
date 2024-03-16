<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Reel\ReelResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\Reel;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        $user = User::find($request->user()->id);
        $posts = Post::where("created_by", "=", $user->id)->get();
        $reels = Reel::where("created_by", "=", $user->id)->get();

        return response()->json([
            "data" => new UserResource($user),
            "posts" => PostResource::collection($posts),
            "reels" => ReelResource::collection($reels),
        ]);
    }
}
