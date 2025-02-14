<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tweet extends Model
{
    /** @use HasFactory<\Database\Factories\TweetFactory> */
    use HasFactory;

    // フィールドの定義
    protected $fillable = ['tweet'];

    // TweetとUserのリレーションを定義
    public function user()
    {
        // 1つのTweetは1人のUserに属する
        return $this->belongsTo(User::class);
    }

    // TweetとLikeのリレーションを定義
    public function likes(): HasMany
    {
        // 1つのTweetは複数のLikeを持つ
        return $this->hasMany(Like::class);
    }
}
