<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // user_idとtweet_idを一括代入可能にする
    protected $fillable = ['user_id', 'tweet_id'];
}
