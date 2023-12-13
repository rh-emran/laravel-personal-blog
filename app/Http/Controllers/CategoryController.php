<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category.index', [
            'categories' => Category::with('articles')->orderby('id', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        flash()->addSuccess('Category added successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,'.$category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        flash()->addSuccess('Category updated successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Retrieve the articles with their associated tags
        $articles = $category->articles()->get();

        // Delete the tags associated with each article
        foreach ($articles as $article) {
            $article->tags()->detach();
            // Delete article image
            if ($article->image && file_exists($article->image)) {
                File::delete($article->image);
            }
        }

        // Delete the related articles
        $category->articles()->delete();

        // Delete the category
        $category->delete();
        flash()->addSuccess('Category deleted successfully.');
        return redirect()->route('category.index');
    }
}
