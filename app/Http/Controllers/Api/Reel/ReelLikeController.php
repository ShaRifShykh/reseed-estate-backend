<?php

namespace App\Http\Controllers\Api\Reel;

use App\Http\Controllers\Controller;
use App\Http\Resources\Reel\ReelResource;
use App\Models\Like;
use App\Models\Reel;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class ReelLikeController extends Controller
{
    public function index(Request $request)
    {
        $likedReels = Like::where("liked_by", "=", $request->user()->id)
            ->where("reel_id", "!=", null)
            ->pluck("reel_id");

        $reels = Reel::whereIn("id", $likedReels)->get();

        return response()->json([
            "data" => ReelResource::collection($reels)
        ], 200);
    }


    public function store(Request $request, $id)
    {
        $hasLiked = Like::where("liked_by", "=", $request->user()->id)
            ->where("reel_id", "=", $id)->first();

        if (isEmpty($hasLiked)) {
            Like::create([
                "liked_by" => $request->user()->id,
                "reel_id" => $id,
            ]);
        }

        return response()->json([
            "success" => true,
        ], 200);
    }


    public function destroy(Request $request, $id)
    {
        $like = Like::where("liked_by", "=", $request->user()->id)
            ->where("reel_id", "=", $id)->first();

        if (!isEmpty($like)) {
            $like->delete();
        }

        return response()->json([
            "success" => true,
        ], 200);
    }
}
