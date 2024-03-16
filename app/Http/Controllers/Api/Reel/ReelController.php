<?php

namespace App\Http\Controllers\Api\Reel;

use App\Http\Controllers\Controller;
use App\Http\Resources\Reel\ReelResource;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Reel;
use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReelController extends Controller
{
    public function index(Request $request)
    {
        $reels = Reel::orderBy("id", "DESC")->paginate(10);
        return ReelResource::collection($reels);
    }


    public function get(Request $request, $id)
    {
        $reels = Reel::where("created_by", "=", $id)
            ->orderBy("id", "DESC")
            ->paginate(10);

        return ReelResource::collection($reels);
    }


    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'video' => 'required|max:100096',
            'description' => 'nullable',
        ]);

        if ($validation->fails()) {
            return response()->json([
                "errors" => $validation->errors()
            ], 400, [], JSON_NUMERIC_CHECK);
        }

        $uploadFolder = "reel/videos";
        $img = $request->file("video");
        $imgUploadedPath = $img->store($uploadFolder, "public");
        Storage::disk("public")->url($imgUploadedPath);

        $reel = new Reel();
        $reel->video = $imgUploadedPath;
        $reel->description = $request->description;
        $reel->created_by = $request->user()->id;
        $reel->save();

        return response()->json([
            "data" => new ReelResource($reel)
        ], 200);
    }


    public function hasLiked(Request $request, $id)
    {
        $hasLiked = Like::where("reel_id", "=", $id)
            ->where("liked_by", "=", $request->user()->id)
            ->exists();

        return response()->json([
            "has_liked" => $hasLiked
        ]);
    }


    public function totalComments(Request $request, $id)
    {
        $totalComments = Comment::where("reel_id", "=", $id)
            ->count();

        return response()->json([
            "total_comments" => $totalComments
        ]);
    }


    public function totalLikes(Request $request, $id)
    {
        $totalLikes = Like::where("reel_id", "=", $id)
            ->count();

        return response()->json([
            "total_likes" => $totalLikes
        ]);
    }


    public function totalShares(Request $request, $id)
    {
        $totalShares = Share::where("reel_id", "=", $id)
            ->count();

        return response()->json([
            "total_shares" => $totalShares
        ]);
    }
}
