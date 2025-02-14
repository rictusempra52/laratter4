<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // likesテーブルを作成
        Schema::create('likes', function (Blueprint $table) {
            // 自動インクリメントのidカラムを追加
            $table->id();
            // user_idカラムを追加し、usersテーブルのidカラムに外部キー制約を設定
            // ユーザーが削除された場合、それに関連するいいねも自動的に削除されるように設定
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // tweet_idカラムを追加し、tweetsテーブルのidカラムに外部キー制約を設定
            // ツイートが削除された場合、それに関連するいいねも自動的に削除される
            $table->foreignId('tweet_id')->constrained()->cascadeOnDelete();
            // created_atとupdated_atのタイムスタンプカラムを追加
            $table->timestamps();
            // user_idとtweet_idの組み合わせがユニークであることを保証
            $table->unique(['user_id', 'tweet_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
