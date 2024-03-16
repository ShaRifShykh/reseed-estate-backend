<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "followed_by"
    ];


    public function followedBy()
    {
        return $this->belongsTo(User::class, "followed_by", "id")
            ->withExists("isFollowing")
            ->withExists("isFollower");
    }

    public function following()
    {
        return $this->belongsTo(User::class, "user_id", "id")
            ->withExists("isFollowing")
            ->withExists("isFollower");
    }
}
