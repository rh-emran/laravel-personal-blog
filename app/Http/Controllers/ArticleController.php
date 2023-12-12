<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('article.index',[
            'articles' => Article::with('category')->orderby('id', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create',[
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:articles|max:255',
            'full_text' => 'required',
            'category' => 'required',
            'tags' => 'required|array|min:1',
        ]);

        $imageName = '';
        if ($image = $request->file('image')) {
            $imageTempName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('upload/article', $imageTempName);
            $imageName = 'upload/article/' . $imageTempName;
        }

        // Save news data into database
        $article = Article::create([
            'title' => $request->title,
            'full_text' => $request->full_text,
            'category_id' => $request->category,
            'author_id' => Auth::id(),
            'image' => $imageName
        ]);

        $tagIds = request('tags');
        $article->tags()->attach($tagIds);

        flash()->addSuccess('Article added successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('article.edit',[
            'article' => $article,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|max:255',
            'full_text' => 'required',
            'category' => 'required',
            'tags' => 'required|array|min:1',
        ]);

        $imageName = '';
        if ($request->deleteImage || $request->file('image')) {
            if (file_exists($article->image) && !empty($article->image)) {
                File::delete($article->image);
            }

            if ($image = $request->file('image')) {
                $imageTempName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('upload/article', $imageTempName);
                $imageName = 'upload/article/' . $imageTempName;
            }
        } else {
            $imageName = $article->image;
        }

        $article->update([
            'title' => $request->title,
            'full_text' => $request->full_text,
            'category_id' => $request->category,
            'image' => $imageName
        ]);

        // Sync tags for the article
        $tagIds = $request->input('tags', []);
        $article->tags()->sync($tagIds);

        flash()->addSuccess('Article updated successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if (file_exists($article->image)) {
            File::delete($article->image);
        }
        $article->tags()->detach();
        $article->delete();

        flash()->addSuccess('Article deleted successfully.');
        return redirect()->route('article.index');
    }
}
