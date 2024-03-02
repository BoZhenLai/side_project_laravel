@extends('layouts.article')
@section('main')
    <h1 class="font-thin text-cyan-600 text-4xl">{{ $article['title'] }}</h1>
    <div class="border-t-2 border-gray-300 my-1 p-2">
        <h3 class="font-bold text-lg text-gray-700">{{ $article['content'] }}</h3>
        <p>{{ $article['created_at'] }} 由 {{ $article->user['name'] }} 發表</p>
        <a href="{{ route('articles.index') }}">回文章列表</a>
    </div>
@endsection
