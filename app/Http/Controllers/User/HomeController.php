<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = $this->getArticles();
        foreach ($articles as $article) {
            $article->banner = 'data_file/'.$article->banner;
        }

        return view('client.pages.index')->with(compact('articles'));
    }

    private function getArticles()
    {
        return Article::where('is_draft', false)->take(3)->get();
    }
}
