<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory;

    // フィールドの定義
    protected $fillable = ['name', 'email', 'password'];

    // UserとTweetのリレーションを定義
    public function tweets(): HasMany
    {
        // 1人のUserは複数のTweetを持つ
        return $this->hasMany(Tweet::class);
    }

    // UserとLikeのリレーションを定義　
    public function likes(): HasMany
    {
        // 1人のUserは複数のLikeを持つ
        return $this->hasMany(Like::class);
    }

    // Define the relationship between User and Tweet
    public function likedTweets()
    {
        // A user has many liked tweets
        return $this->belongsToMany(Tweet::class)->withTimestamps();
    }
}
