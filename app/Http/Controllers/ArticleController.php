<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\ArticleStoreRequest;

class ArticleController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('articles.create', ['categories' => $categories]);
    }

    public function post(ArticleStoreRequest $request)
    {
        try {
            Article::create([
                'title' => $request->input('title'),
                'intro' => $request->input('intro'),
                'content' => $request->input('content'),
                'publication_date' => Carbon::parse($request->input('publication_date')),
            ]);
            return redirect()->route('articles.dashboard')->with('success', 'Nieuw artikel toegevoegd');
        } catch (\Exception $e) {
            return redirect()->route('articles.create', ['article' => new Article()])->withInput()->with('error', 'Er is iets mis gegaan bij het maken van een nieuw artikel');
        }
    }

    public function show($id)
    {
        if (!($article = Article::find($id))) {
            abort(404);
        } else {
            return view('articles.show', ['article' => $article]);
        }
    }

    public function edit(Request $request, $id)
    {
        $categories = Category::all();

        if ($request->isMethod('get') && ($article = Article::find($id))) {
            return view('articles.edit', ['article' => $article, 'categories' => $categories]);;
        } else {
            return redirect()->route('articles.dashboard')->with('error', 'Artikel kon niet worden bewerkt (niet gevonden)');
        }
    }

    public function update(ArticleStoreRequest $request, $id)
    {
        if ($article = Article::find($id)) {
            $article->update([
                'title' => $request->input('title'),
                'intro' => $request->input('intro'),
                'content' => $request->input('content'),
                'publication_date' => Carbon::parse($request->input('publication_date')),
                'category_id' => $request->input('category_id'),
            ]);
            return redirect()->route('articles.dashboard')->with('success', 'Artikel bijgewerkt');
        } else {
            return redirect()->route('articles.dashboard')->with('error', 'Artikel kon niet worden bewerkt (niet gevonden)');
        }
    }

    public function delete($id)
    {
        if ($article = Article::find($id)) {
            $article->delete();
            return redirect()->route('articles.dashboard')->with('success', 'Artikel verwijderd');
        } else {
            return redirect()->route('articles.dashboard')->with('error', 'Artikel kon niet worden verwijderd (niet gevonden)');
        }
    }

    public function index()
    {
        $articles = Article::whereDate('publication_date', '<=', now())->get();

        return view('articles.index', ['articles' => $articles]);
    }


    public function dashboard()
    {
        $articles = Article::all();

        return view('articles.dashboard', ['articles' => $articles]);
    }
}
