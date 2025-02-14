<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;

class TweetLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * 新しく作成されたリソースをストレージに保存します。
     * nameはlikeとしています
     * @param Tweet $tweet いいねを追加する対象のツイート
     * @return \Illuminate\Http\RedirectResponse リダイレクトレスポンスを返します
     */
    public function store(Tweet $tweet)
    {
        // 現在認証されているユーザーのIDを取得し、そのユーザーがツイートにいいねを付ける
        if (Auth::check()) {
            $tweet->likedBy()->attach(auth()->id());
            return back();
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to like a tweet.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet)
    {
        // 現在認証されているユーザーのIDを取得し、そのユーザーがツイートにいいねを付ける
        if (Auth::check()) {
            $tweet->likedBy()->detach(auth()->id());
            return back();
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to unlike a tweet.');
        }
    }
}
