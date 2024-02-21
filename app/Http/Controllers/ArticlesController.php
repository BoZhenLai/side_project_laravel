<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        // $articles = Article::orderByDesc('created_at')->get();
        // $articles = Article::cursorPaginate(4);
        $articles = Article::orderByDesc('created_at')->paginate(4);
        return view('articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        return view('articles.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'unique:App\Models\Article,title', 'max:32'],
            'content' => 'required',
        ]);

        auth()->user()->articles()->create($data);
        return redirect()->route('root')->with('success', '文章新增成功');
    }

    public function edit($article_id)
    {
        $data = auth()->user()->articles()->firstWhere('id', $article_id);
        // $data = Article::find($article_id);
        return view('articles.edit', ['article' => $data]);
    }

    public function update(Request $request, $article_id)
    {
        $data = $request->validate([
            'title' => ['required', 'unique:App\Models\Article,title', 'max:32'],
            'content' => 'required',
        ]);

        auth()->user()->articles()->firstWhere('id', $article_id)->update(['title' => $data['title'], 'content' => $data['content']]);
        return redirect()->route('root')->with('success', '編輯成功');
    }
}
