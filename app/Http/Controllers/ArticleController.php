<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ArticleController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function post(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'intro' => 'required|string',
            'content' => 'required|string',
            'publication_date' => 'required|date',
        ]);

        try {
            Article::create([
                'title' => $request->input('title'),
                'intro' => $request->input('intro'),
                'content' => $request->input('content'),
                'publication_date' => Carbon::parse($request->input('publication_date')),
            ]);
            return redirect()->route('articles.dashboard')->with('success', 'Nieuw artikel toegevoegd');
        } catch (\Exception $e) {
            return redirect()->route('articles.create', ['article' => new Article()])->withInput()->with('error', 'Er is iets misgegaan bij het maken van een nieuw artikel');
        }
    }

    public function show($id)
    {
        if (!($article = Article::find($id))) {
            abort(404);
        } else {
            return view('show', ['article' => $article]);
        }
    }

    public function edit(Request $request, $id)
    {
        if ($request->isMethod('get') && ($article = Article::find($id))) {
            return view('edit', ['article' => $article]);;
        } elseif ($request->isMethod('post') && ($article = Article::find($id))) {
            $request->validate([
                'title' => 'required|string|max:255',
                'intro' => 'required|string',
                'content' => 'required|string',
                'publication_date' => 'required|date',
            ]);

            $article->update([
                'title' => $request->input('title'),
                'intro' => $request->input('intro'),
                'content' => $request->input('content'),
                'publication_date' => Carbon::parse($request->input('publication_date')),
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

        return view('index', ['articles' => $articles]);
    }


    public function dashboard()
    {
        $articles = Article::all();

        return view('dashboard', ['articles' => $articles]);
    }
}
