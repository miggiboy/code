<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article\{Article, Category};

use App\Http\Requests\Article\ArticleFormRequest;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at')->paginate(15);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleFormRequest $request)
    {

        $article = Article::create($request->except('new_category', 'categories'));

        $categories = collect($request->categories ?: []);

        if ($request->has('new_category')) {

            $category = Category::create(['title' => $request->new_category]);

            $categories->push($category->id);
        }

        $article->categories()->attach($categories);

        return redirect()
            ->route('articles')
            ->with('message', 'Статья успешно добавлена.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Article $article, ArticleFormRequest $request)
    {
        $article->update($request->except('new_category', 'categories'));

        $categories = collect($request->categories ?: []);

        if ($request->has('new_category')) {

            $category = Category::create(['title' => $request->new_category]);

            $categories->push($category->id);
        }

        $article->categories()->detach();
        $article->categories()->attach($categories);

        return redirect()
            ->route('articles')
            ->with('message', 'Статья успешно обновлена.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return back()->with('message', 'Статья удалена.');
    }
}
