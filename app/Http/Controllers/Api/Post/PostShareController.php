<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Models\Share;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class PostShareController extends Controller
{
    public function store(Request $request, $id)
    {
        $hasShared = Share::where("shared_by", "=", $request->user()->id)
            ->where("post_id", "=", $id)->first();

        if (!isEmpty($hasShared)) {
            Share::create([
                "shared_by" => $request->user()->id,
                "post_id" => $id,
            ]);
        }

        return response()->json([
            "success" => true,
        ]);
    }


    public function destroy(Request $request, $id)
    {
        $share = Share::where("shared_by", "=", $request->user()->id)
            ->where("post_id", "=", $id)->first();

        $share->delete();

        return response()->json([
            "success" => true,
        ]);
    }
}
