<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Comment;
use App\Models\Hashtag;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostHashtag;
use App\Models\PostTagUser;
use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::orderBy("id", "DESC")->paginate(10);
        return PostResource::collection($posts);
    }


    public function get(Request $request, $id)
    {
        $posts = Post::where("created_by", "=", $id)
            ->orderBy("id", "DESC")
            ->paginate(10);

        return PostResource::collection($posts);
    }


    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'asset' => 'required|max:100096',
            'description' => 'required',
            'price' => 'required',
            'location' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                "errors" => $validation->errors()
            ], 400, [], JSON_NUMERIC_CHECK);
        }

        if ($request->file("asset")) {
            $uploadFolder = "posts/assets";
            $img = $request->file("asset");
            $imgUploadedPath = $img->store($uploadFolder, "public");
            Storage::disk("public")->url($imgUploadedPath);
        }

        $post = new Post();
        $post->asset = $imgUploadedPath;
        $post->description = $request->description;
        $post->price = $request->price;
        $post->location = $request->location;
        $post->latitude = $request->latitude;
        $post->longitude = $request->longitude;
        $post->created_by = $request->user()->id;
        $post->save();

        if (!isEmpty($request->hashtags)) {
            foreach ($request->hashtags as $hashtag) {
                $hashtagExists = Hashtag::where("name", "=", $hashtag)
                    ->first();

                if (isEmpty($hashtagExists)) {
                    Hashtag::create([
                        "name" => $hashtag,
                    ]);
                }

                PostHashtag::create([
                    "post_id" => $post->id,
                    "hashtag_id" => $hashtag,
                ]);
            }
        }

        if (!isEmpty($request->people_tags)) {
            foreach ($request->people_tags as $peopleTag) {
                PostTagUser::create([
                    "post_id" => $post->id,
                    "user_id" => $peopleTag,
                ]);
            }
        }

        return response()->json([
            "data" => new PostResource($post)
        ], 200);
    }


    public function hasLiked(Request $request, $id)
    {
        $hasLiked = Like::where("post_id", "=", $id)
            ->where("liked_by", "=", $request->user()->id)
            ->exists();

        return response()->json([
            "has_liked" => $hasLiked
        ]);
    }


    public function totalComments(Request $request, $id)
    {
        $totalComments = Comment::where("post_id", "=", $id)
            ->count();

        return response()->json([
            "total_comments" => $totalComments
        ]);
    }


    public function totalLikes(Request $request, $id)
    {
        $totalLikes = Like::where("post_id", "=", $id)
            ->count();

        return response()->json([
            "total_likes" => $totalLikes
        ]);
    }


    public function totalShares(Request $request, $id)
    {
        $totalShares = Share::where("post_id", "=", $id)
            ->count();

        return response()->json([
            "total_shares" => $totalShares
        ]);
    }
}
