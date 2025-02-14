<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * すべての「いいね」を表示
     */
    public function index()
    {
        // すべての「いいね」を取得
        $likes = Like::all();
        // 取得した「いいね」を返す
        return response()->json($likes);
    }

    /**
     * 新しい「いいね」を作成
     */
    public function store(Request $request)
    {
        // user_idをリクエストに追加
        $request->merge(['user_id' => Auth::id()]);

        // リクエストデータのバリデーション
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tweet_id' => 'required|exists:tweets,id',
        ]);

        // 新しい「いいね」を作成
        $like = Like::create($validated);
        // 作成した「いいね」を返す
        return response()->json($like, 201);
    }

    /**
     * 特定の「いいね」を表示
     */
    public function show($id)
    {
        // 指定されたIDの「いいね」を取得
        $like = Like::findOrFail($id);
        // 取得した「いいね」を返す
        return response()->json($like);
    }

    /**
     * 特定の「いいね」を更新
     */
    public function update(Request $request, $id)
    {
        // 指定されたIDの「いいね」を取得
        $like = Like::findOrFail($id);

        // リクエストデータのバリデーション
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tweet_id' => 'required|exists:tweets,id',
        ]);

        // 「いいね」を更新
        $like->update($validated);
        // 更新した「いいね」を返す
        return response()->json($like);
    }

    /**
     * 特定の「いいね」を削除
     */
    public function destroy($id)
    {
        // 指定されたIDの「いいね」を取得
        $like = Like::findOrFail($id);
        // 「いいね」を削除
        $like->delete();
        // 削除成功のレスポンスを返す
        return response()->json(null, 204);
    }
}
