<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Exception;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getDetailsForUser($id)
    {
        $article = Article::findOrFail($id);
        // dd($article);
        return view('articlesDetailsUser' , ['article' => $article]);
    }
    public function getArticlesForImam()
    {
        $articles = Article::where('imam_id', auth()->user()->id)->paginate(6);
        return view('imam/imamArticles', ['articles' => $articles]);
    }

    public function getArticlesForUsers()
    {
        $articles = Article::all();
        return $articles;
    }
    public function store(Request $request)
    {
        // dd($request->all());     
        try {
            $request->validate([
                'name'   => 'required|string|max:255',
                'image'   => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
                'description' => 'required|string',
            ]);

            // Traitement de l'image (si elle existe)
            $imagePath = null;
            if ($request->hasFile('image')) {
                $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs('public/articles', $filename);
                $imagePath = $filename;
            }
            $article = new Article();
            $article->name = $request->input('name');
            $article->image = $imagePath;

            $article->description =  $request->input('description');
            $article->imam()->associate(auth()->user());
            $article->save();
            
            return redirect()->back()->with('success', 'Article créé avec succès.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Request $request ) {
        $article = Article::findOrFail($request->article_id);
        $request->validate([
                'name'   => 'required|string|max:255',
                'description' => 'required|string',
            ]);
        $article->name = $request->name;
        $article->description = $request->description;
        $article->save();
        return redirect()->back()->with('success' , 'article mise à jours avec succes');
    }
    public function show($id) {
        $article = Article::findOrFail($id);
        return view('imam/articleDetails' , ['article' => $article]);
    }
    public function destroy($id) {
        // dd($id);
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->back()->with('success' , 'l\'article a été supprimer avec succes');

    }
}
