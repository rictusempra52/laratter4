<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Tweet extends Model
{
    /** @use HasFactory<\Database\Factories\TweetFactory> */
    use HasFactory;
    // Define the fillable fields
    protected $fillable = ['tweet'];

    // Define the relationship between Tweet and User
    public function user()
    {
        // A tweet belongs to a user
        return $this->belongsTo(User::class);
    }

    /** いいねをしたユーザーを取得する
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likedBy()
    {
        // ツイートは多くのユーザーに「いいね」される
        // belongsToManyメソッドを使用して多対多の関係を定義
        // withTimestampsメソッドを使用して、関連するタイムスタンプを自動的に管理
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
