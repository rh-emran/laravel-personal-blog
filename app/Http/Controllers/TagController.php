<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tag.index', [
            'tags' => Tag::with('articles')->orderby('id', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags|max:255',
        ]);

        Tag::create([
            'name' => $request->name,
        ]);

        flash()->addSuccess('Tag added successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tag.edit', [
            'tag' => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|max:255|unique:tags,name,'.$tag->id,
        ]);

        $tag->update([
            'name' => $request->name,
        ]);

        flash()->addSuccess('Tag updated successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        // Get all articles that have this tag
        $articles = $tag->articles;

        // Detach the tag from all articles
        foreach ($articles as $article) {
            $article->tags()->detach($tag->id);
        }

        // Delete the tag
        $tag->delete();
        flash()->addSuccess('Tag deleted successfully.');
        return redirect()->route('tag.index');
    }
}
