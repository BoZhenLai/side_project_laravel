@extends('layouts.article')
@section('main')
    <h1 class="font-thin text-cyan-600 text-4xl">文章列表</h1>
    <a href="{{ route('articles.create') }}">新增文章</a>
    {{-- <pre>{{ print_r($articles, true) }}</pre> --}}
    @foreach ($articles as $article)
        <div class="border-t-2 border-gray-300 my-1 p-2">
            <h3 class="font-bold text-lg">{{ $article['title'] }}</h3>
            <p>{{ $article['created_at'] }} 由 {{ $article->user['name'] }} 發表</p>
            <a href="{{ route('articles.edit', ['article' => $article['id']]) }}">編輯</a>
        </div>
    @endforeach
    {{ $articles->links() }}
@endsection
