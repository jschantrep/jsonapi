<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;
use Illuminate\Support\Str;



class ArticleController extends Controller
{
    public function show(Article $article)
    {
        return ArticleResource::make($article);
    }

    public function index()
    {
        $articles = Article::applySorts(request('sort'))->get();
        return ArticleCollection::make($articles);
    }
}
