<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "comment", "comment_by", "parent_id",
        "post_id", "reel_id"
    ];


    public function commentBy()
    {
        return $this->belongsTo(User::class, "comment_by", "id");
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, "parent_id", "id");
    }

    public function post()
    {
        return $this->belongsTo(Post::class, "post_id", "id");
    }

    public function reel()
    {
        return $this->belongsTo(Reel::class, "reel_id", "id");
    }
}
