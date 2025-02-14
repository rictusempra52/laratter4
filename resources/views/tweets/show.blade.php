<!-- resources/views/tweets/show.blade.php -->

<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<x-app-layout>
    <x-slot name="header">
        <h2
            class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight border-b border-gray-200 pb-4 mb-4">
            {{ __('Tweet詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('tweets.index') }}" class="link mr-2">一覧に戻る</a>
                    <p class="text-gray-800 dark:text-gray-300 text-lg mt-4">{{ $tweet->tweet }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">投稿者: {{ $tweet->user->name }}</p>
                    <div class="text-gray-600 dark:text-gray-400 text-sm mt-2">
                        <p>作成日時: {{ $tweet->created_at->format('Y-m-d H:i') }}</p>
                        <p>更新日時: {{ $tweet->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                    @if (auth()->id() == $tweet->user_id)
                        <div class="flex mt-4 space-x-2">
                            <a href="{{ route('tweets.edit', $tweet) }}" class="link mr-2">編集</a>
                            <form action="{{ route('tweets.destroy', $tweet) }}" method="POST"
                                onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn mr-2">削除</button>
                            </form>
                        </div>
                    @endif
                    {{-- 🔽 追加 --}}
                    <div class="flex mt-4 space-x-2">
                        @if ($tweet->likedBy->contains(auth()->id()))
                            <form action="{{ route('tweets.dislike', $tweet) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn mr-2 like-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24" class="fill-current text-red-500 filled">
                                        <path
                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                    {{ $tweet->likedBy->count() }}</button>
                            </form>
                        @else
                            <form action="{{ route('tweets.like', $tweet) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn mr-2 like-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24" class="fill-current text-red-500">
                                        <path
                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                    {{ $tweet->likedBy->count() }}</button>
                            </form>
                        @endif
                    </div>
                    {{-- 🔼 ここまで --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
