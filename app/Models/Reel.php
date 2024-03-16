<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reel extends Model
{
    use HasFactory;

    protected $fillable = [
        "video", "description", "created_by"
    ];


    public function createdBy()
    {
        return $this->belongsTo(User::class, "created_by", "id");
    }

    public function likes()
    {
        return $this->hasMany(Like::class, "reel_id", "id");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, "reel_id", "id");
    }

    public function shares()
    {
        return $this->hasMany(Share::class, "reel_id", "id");
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
}
