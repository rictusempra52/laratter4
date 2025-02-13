<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ユーザー情報を含むツイートを最新のものから順に取得し、ビューに渡す
        $tweets = Tweet::with('user')->latest()->get();
        // ツイート一覧ページを表示
        return view('tweets.index', compact('tweets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Tweet $tweet)
    {
        // ツイート作成ページを表示
        return view('tweets.create', compact('tweet'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'tweet' => 'required|max:140',
        ]);

        // ログインしているユーザーのツイートを作成
        // $request->user() は現在ログインしているユーザーを取得
        // tweets() はユーザーが持つツイートのリレーションを取得
        // create() メソッドで新しいツイートを作成し、データベースに保存
        // $request->only('tweet') はリクエストから 'tweet' フィールドのみを取得
        $request->user()->tweets()->create($request->only('tweet'));

        // ツイート一覧ページにリダイレクト
        return redirect()->route('tweets.index');
    }

    /**
     * ツイート詳細ページを表示するメソッド。
     * 
     * このメソッドは、指定されたツイートの詳細情報を表示するためのビューを返します。
     * @param Tweet $tweet ツイートモデルのインスタンス
     * @return \Illuminate\View\View ツイート詳細ページのビューを返します。
     */
    public function show(Tweet $tweet)
    {
        return view('tweets.show', compact('tweet'));
    }

    /**
     * ツイートを編集するためのフォームを表示するメソッド。
     */
    public function edit(Tweet $tweet)
    {
        // ツイート編集ページを表示
        return view('tweets.edit', compact('tweet'));
    }

    /**
     * ツイートを更新するメソッド。
     */
    public function update(Request $request, Tweet $tweet)
    {
        // バリデーション
        $request->validate([
            'tweet' => 'required|max:140',
        ]);

        // ツイートを更新
        $tweet->update($request->only('tweet'));

        // ツイート詳細ページにリダイレクト
        return redirect()->route('tweets.show', $tweet);
    }

    /**
     * ツイートを削除するメソッド。
     */
    public function destroy(Tweet $tweet)
    {
        // ツイートを削除
        $tweet->delete();

        // ツイート一覧ページにリダイレクト
        return redirect()->route('tweets.index');
    }
}
