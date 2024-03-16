<?php

namespace App\Http\Controllers\Api\Reel;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReelCommentController extends Controller
{
    public function get(Request $request, $id)
    {
        $comments = Comment::where("reel_id", "=", $id)->get();

        return CommentResource::collection($comments);
    }


    public function store(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'comment' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json([
                "errors" => $validation->errors()
            ], 400, [], JSON_NUMERIC_CHECK);
        }

        $comment = Comment::create([
            "comment" => $request->comment,
            "comment_by" => $request->user()->id,
            "parent_id" => $request->parent_id ?? null,
            "reel_id" => $id,
        ]);

        return response()->json([
            "data" => new CommentResource($comment),
        ], 200);
    }
}
