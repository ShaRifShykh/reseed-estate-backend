<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Reel\ReelResource;
use App\Models\Like;
use App\Models\Post;
use App\Models\Reel;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class PostLikeController extends Controller
{
    public function index(Request $request)
    {
        $likedPosts = Like::where("liked_by", "=", $request->user()->id)
            ->where("post_id", "!=", null)
            ->pluck("post_id");

        $posts = Post::whereIn("id", $likedPosts)->get();

        return response()->json([
            "data" => PostResource::collection($posts)
        ], 200);
    }


    public function store(Request $request, $id)
    {
        $hasLiked = Like::where("liked_by", "=", $request->user()->id)
            ->where("post_id", "=", $id)->first();

        if (isEmpty($hasLiked)) {
            Like::create([
                "liked_by" => $request->user()->id,
                "post_id" => $id,
            ]);
        }

        return response()->json([
            "success" => true,
        ], 200);
    }


    public function destroy(Request $request, $id)
    {
        $like = Like::where("liked_by", "=", $request->user()->id)
            ->where("post_id", "=", $id)->first();

        $like->delete();

        return response()->json([
            "success" => true,
        ], 200);
    }
}
