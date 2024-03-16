<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostHashtag extends Model
{
    use HasFactory;

    protected $fillable = [
        "post_id", "hashtag_id"
    ];


    public function hashtag()
    {
        return $this->belongsTo(Hashtag::class, "hashtag_id", "name");
    }
}
