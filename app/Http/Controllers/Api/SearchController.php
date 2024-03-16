<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Reel\ReelResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\Reel;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->search;

        $posts = Post::where('description', '=', "%". $query ."%")
            ->orWhere('location', 'LIKE', "%". $query ."%")
            ->get();

        $reels = Reel::where('description', 'LIKE', "%". $query ."%")
            ->get();

        $users = User::where('full_name', 'LIKE', "%". $query ."%")
            ->orWhere('username', 'LIKE', "%". $query ."%")
            ->get();

        return response()->json([
            "posts" => PostResource::collection($posts),
            "reels" => ReelResource::collection($reels),
            "users" => UserResource::collection($users),
        ], 200);
    }
}
