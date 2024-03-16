<?php

namespace App\Http\Resources;

use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Reel\ReelResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            "comment" => $this->comment,
            "created_at" => $this->created_at->diffForHumans(),
            "user" => new UserResource($this->commentBy),
            "post" => new PostResource($this->post),
            "reel" => new ReelResource($this->reel),
            "replies" => CommentResource::collection($this->replies)
        ];
    }
}
