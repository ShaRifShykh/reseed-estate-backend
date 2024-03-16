<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Follow\FollowerResource;
use App\Http\Resources\Follow\FollowingResource;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request, $to)
    {
        $isFollowing = Follower::where("user_id", "=", $to)
            ->where("followed_by", "=", $request->user()->id)->first();

        if ($isFollowing == null) {
            Follower::create([
                "user_id" => $to,
                "followed_by" => $request->user()->id,
            ]);

//            $user = User::find($request->user()->id);
//            $user2 = User::find($to);
//
//            $hasOldNotification = Notification::where("to", "=", $to)
//                ->where("by", "=", $request->user()->id)
//                ->where("body", "=", $request->user()->first_name . " started following you.")
//                ->latest("created_at")->first();
//
//            if ($hasOldNotification != null) {
//                if ($hasOldNotification->created_at > now()) {
//                    $this->sendNotification($request, $to);
//                }
//            } else {
//                $this->sendNotification($request, $to);
//            }

            return response()->json([
//                "data" => new UserResource($user),
//                "data2" => new UserResource($user2),
            "success" => true,
            ], 200);
        } else {
            return response()->json([
                "errors" => [
                    "error" => "Already following!"
                ],
            ], 400);
        }
    }

    public function unFollow(Request $request, $to)
    {
        $user = User::find($request->user()->id);
        $user2 = User::find($to);

        $isFollowing = Follower::where("user_id", "=", $user2->id)
            ->where("followed_by", "=", $user->id)->first();
        $isFollowing->delete();

        return response()->json([
//            "data" => new UserResource($user),
//            "data2" => new UserResource($user2),
        "success" => true,
        ], 200);
    }


    public function followings(Request $request, $id)
    {
        $followings = Follower::where("followed_by", "=", $id)
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            "data" => FollowingResource::collection($followings)
        ], 200);
    }

    public function followers(Request $request, $id)
    {
        $followers = Follower::where("user_id", "=", $id)
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            "data" => FollowerResource::collection($followers)
        ], 200);
    }
}
