<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            "asset" => $this->asset,
            "description" => $this->description,
            "price" => $this->price,
            "location" => $this->location,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "created_at" => $this->created_at->diffForHumans(),
            "total_likes" => $this->totalLikes(),
            "total_comments" => $this->totalComments(),
            "total_shares" => $this->totalShares(),
            "has_liked" => $this->hasLiked(),
            "created_by" => new UserResource($this->createdBy),
        ];
    }
}
