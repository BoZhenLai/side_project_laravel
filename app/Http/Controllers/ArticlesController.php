<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Dompdf\Dompdf;

// require 'vendor/autoload.php';
class ArticlesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        // $articles = Article::orderByDesc('created_at')->get();
        // $articles = Article::cursorPaginate(4);
        $articles = Article::with('user')->orderByDesc('created_at')->paginate(4);
        return view('articles.index', ['articles' => $articles]);
    }

    public function show($article_id)
    {
        $article = Article::where('id', $article_id)->first();
        return view('articles.show', ['article' => $article]);
    }

    public function export($article_id)
    {
        $article = Article::where('id', $article_id)->first();

        // get contents of a file into a string
        // $filename = __DIR__ . "/pdf.temple.blade.html";
        // $handle = fopen($filename, "r");
        // $contents = fread($handle, filesize($filename));
        // fclose($handle);

        // $contents = str_replace('{title}', $article['title'], $contents);
        // $contents = str_replace('{user_name}', $article->user['name'], $contents);
        // $contents = str_replace('{content}', $article['content'], $contents);

        $contents = view('pdf.temple', ['article' => $article])->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($contents);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($article['title'] . '.pdf', ['Attachment' => false]);
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

        if (isset($data)) {
            return view('articles.edit', ['article' => $data]);
        } else {
            return redirect()->route('root')->with('error', '權限不足');
        }
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

    public function destroy($article_id)
    {
        $data = auth()->user()->articles()->firstWhere('id', $article_id);
        // $data = Article::find($article_id);

        // auth()->user()->articles()->firstWhere('id', $article_id)->delete();
        if (isset($data)) {
            $data->delete();
            return redirect()->route('root')->with('success', '刪除成功');
        } else {
            return redirect()->route('root')->with('error', '權限不足');
        }
    }
}
