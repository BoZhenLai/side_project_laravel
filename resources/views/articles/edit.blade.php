@extends('layouts.article')
@section('main')
    <h1 class="font-thin text-cyan-600 text-4xl">編輯文章</h1>

    @if ($errors->any())
        <div class="alert alert-danger bg-red-400 py-2 rounded-md my-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', ['article' => $article['id']]) }}" method="post">
        @csrf
        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}
        @method('patch')
        {{-- <input type="hidden" name="_method" value="PUT"> --}}
        <div class="field-container my-4">
            <label for="title">標題</label>
            <input type="text" name="title" id="title" class="rounded-md border-2 p-2" size="40"
                value="{{ $article['title'] }}" />
        </div>
        <div class="field-container my-4">
            <label for="content">內容</label>
            <textarea name="content" id="content" class="rounded-md border-2 p-2" rows="6" cols="40">{{ $article['content'] }}</textarea>
        </div>
        <div class="actions">
            <button type="submit" class="px-3 py-1 rounded-md bg-cyan-500 hover:bg-cyan-600">更新文章</button>
        </div>
    </form>
@endsection
