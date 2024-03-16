<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "asset", "description", "price", "location", "latitude", "longitude",
        "created_by"
    ];


    public function hashtags()
    {
        return $this->hasMany(PostHashtag::class, "post_id", "id");
    }

    public function tagPeoples()
    {
        return $this->hasMany(PostTagUser::class, "post_id", "id");
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, "created_by", "id");
    }

    public function likes()
    {
        return $this->hasMany(Like::class, "post_id", "id");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, "post_id", "id");
    }

    public function shares()
    {
        return $this->hasMany(Share::class, "post_id", "id");
    }


    // Count Relationship
    public function totalLikes()
    {
        return $this->likes()->count();
    }

    public function totalComments()
    {
        return $this->comments()->count();
    }

    public function totalShares()
    {
        return $this->shares()->count();
    }


    // Done Relationship
    public function hasLiked()
    {
        return $this->likes()
            ->where("liked_by", "=", auth()->user()->id)
            ->exists();
    }
}
