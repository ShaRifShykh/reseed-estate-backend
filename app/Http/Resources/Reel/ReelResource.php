<?php

namespace App\Http\Resources\Reel;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReelResource extends JsonResource
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
            "video" => $this->video,
            "description" => $this->description,
            "created_at" => $this->created_at->diffForHumans(),
            "total_likes" => $this->totalLikes(),
            "total_comments" => $this->totalComments(),
            "total_shares" => $this->totalShares(),
            "created_by" => new UserResource($this->createdBy),
        ];
    }
}
