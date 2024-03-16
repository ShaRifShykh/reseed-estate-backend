<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'full_name', 'username', 'phone_number', 'email', 'otp',
        'profile_picture', 'device_token'
    ];

    protected $hidden = [
        'password',
        'otp',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];


    // Relationships
    public function followings()
    {
        return $this->hasMany(Follower::class, "followed_by", "id")->with("following");
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, "user_id", "id")->with("followedBy");
    }


    // Stats Relationships
    public function totalPosts()
    {
        return $this->hasMany(Post::class, "created_by", "id")
            ->count();
    }

    public function totalReels()
    {
        return $this->hasMany(Reel::class, "created_by", "id")
            ->count();
    }

    public function totalFollowings()
    {
        $followings = Follower::where("followed_by", "=", $this->id)
            ->count();

        return $followings;
    }

    public function totalFollowers()
    {

        $followers = Follower::where("user_id", "=", $this->id)
            ->count();

        return $followers;
    }


    // Exists Relationships
    public function isFollowingUser() {
        return $this->followings()->where("user_id", "=", auth()->user()->id)->exists();
    }

    public function isFollowerUser() {
        return $this->followers()->where("followed_by", "=", auth()->user()->id)->exists();
    }

    public function isFollowing() {
        return $this->followings()->where("user_id", "=", auth()->user()->id);
    }

    public function isFollower() {
        return $this->followers()->where("followed_by", "=", auth()->user()->id);
    }
}
