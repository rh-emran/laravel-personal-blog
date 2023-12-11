<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'articles' => Article::with('author', 'category', 'tags')->orderby('id', 'desc')->paginate(5),
        ]);
    }

    public function details(Request $request)
    {
        return view('frontend.single', [
            'article' => Article::with('author', 'category', 'tags')->where('id', $request->id)->first(),
        ]);
    }

    public function about()
    {
        return view('frontend.about');
    }
}
