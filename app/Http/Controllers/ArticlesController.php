<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        return view('articles.index');
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
}
