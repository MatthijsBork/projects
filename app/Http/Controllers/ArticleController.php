<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ArticleStoreRequest;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::whereDate('publication_date', '<=', now())->get();

        return view('articles.index', compact('articles'));
    }

    public function dashboard()
    {
        $articles = Article::paginate(10);

        return view('articles.dashboard', compact('articles'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $articles = Article::where('title', 'LIKE', "%$query%")
            ->orWhere('content', 'LIKE', "%$query%")
            ->paginate(10)->appends(['query' => $query]);

        return view('articles.dashboard', compact('articles'));
    }

    public function create()
    {
        $article = new Article;
        return view('articles.create', compact('article'));
    }

    public function show($id)
    {
        if (!($article = Article::find($id))) {
            abort(404);
        } else {
            return view('articles.show', compact('article'));
        }
    }

    public function edit(Request $request, $id)
    {
        $categories = Category::all();

        if ($request->isMethod('get') && ($article = Article::find($id))) {
            return view('articles.edit', compact('article', 'categories'));;
        } else {
            return redirect()->route('dashboard.articles')->with('error', 'Artikel kon niet worden bewerkt (niet gevonden)');
        }
    }


    public function store(ArticleStoreRequest $request, Article $article)
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->intro = $request->input('intro');
        $article->content = $request->input('content');
        $article->pulication_date = Carbon::parse($request->input('publication_date'));
        $article->category_id = $request->input('category_id');
        $article->save();

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::delete('articles/' . $article->id . '/' . $article->image);
            }
            $imageName = $article->id . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('articles/' . $article->id, $imageName);
            $article->img = $imageName;
            $article->save();
        }

        return redirect()->route('dashboard.articles')->with('success', 'Nieuw artikel toegevoegd');
    }



    public function update(ArticleStoreRequest $request, $id)
    {
        if ($article = Article::find($id)) {
            if ($request->input('delete_image') == 1) {
                Storage::delete('articles/' . $article->id . '/' . $article->img);
                Storage::deleteDirectory('articles/' . $article->id);
                $imagePath = '';
            } elseif ($request->hasFile('image')) {
                Storage::delete('articles/' . $article->id . '/' . $article->img);
                Storage::deleteDirectory('articles/' . $article->id);
                $p = 'public';
                $path = $request->file('image')->store($p, 'public');
                $imagePath = substr($path, strlen($p));
            } else {
                $imagePath = $article->img;
            }
            $article->update([
                'title' => $request->input('title'),
                'intro' => $request->input('intro'),
                'content' => $request->input('content'),
                'publication_date' => Carbon::parse($request->input('publication_date')),
                'category_id' => $request->input('category_id'),
                'img' => $imagePath,
            ]);
            return redirect()->route('dashboard.articles')->with('success', 'Artikel bijgewerkt');
        } else {
            return redirect()->route('dashboard.articles')->with('error', 'Artikel kon niet worden bewerkt (niet gevonden)');
        }
    }

    public function delete($id)
    {
        if ($article = Article::find($id)) {
            Storage::delete('articles/' . $article->id . '/' . $article->img);
            Storage::deleteDirectory('articles/' . $article->id);
            $article->delete();
            return redirect()->route('dashboard.articles')->with('success', 'Artikel verwijderd');
        } else {
            return redirect()->route('dashboard.articles')->with('error', 'Artikel kon niet worden verwijderd (niet gevonden)');
        }
    }
}
