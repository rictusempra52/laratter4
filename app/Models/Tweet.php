<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
