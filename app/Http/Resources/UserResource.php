<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "fullName" => $this->full_name,
            "username" => $this->username,
            "phoneNumber" => $this->phone_number,
            "email" => $this->email,
            "profile_picture" => $this->profile_picture,
            "total_posts" => $this->totalPosts(),
            "total_reels" => $this->totalReels(),
            "total_followings" => $this->totalFollowings(),
            "total_followers" => $this->totalFollowers(),
            // Exits or Not
            "is_following" => $this->isFollowingUser(),
            "is_follower" => $this->isFollowerUser(),
            "createdAt" => $this->created_at,
        ];
    }
}
