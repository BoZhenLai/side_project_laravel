@extends('layouts.article')
@section('main')
    <h1 class="m-1 font-extralight text-cyan-600 text-4xl">文章列表</h1>
    <a class="m-1 font-thin text-cyan-600 text-2xl"href="{{ route('articles.create') }}">新增文章</a>
    {{-- <pre>{{ print_r($articles, true) }}</pre> --}}
    @foreach ($articles as $article)
        <div class="border-t-2 border-gray-300 my-1 p-2">
            <h3 class="font-bold text-lg">
                <a href="{{ route('articles.show', ['article' => $article['id']]) }}">{{ $article['title'] }}</a>
            </h3>
            <p>{{ $article['created_at'] }} 由 {{ $article->user['name'] }} 發表</p>
            <div class="flex">
                <a class="px-2 py-1 m-1 rounded-md bg-cyan-500 hover:bg-cyan-600 text-cyan-50"
                    href="{{ route('articles.edit', ['article' => $article['id']]) }}">編輯</a>
                <form action="{{ route('articles.destroy', ['article' => $article['id']]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit"
                        class="px-2 py-1 m-1 rounded-md bg-red-500 hover:bg-red-600 text-red-50">刪除</button>
                </form>
            </div>
        </div>
    @endforeach
    {{ $articles->links() }}
@endsection
