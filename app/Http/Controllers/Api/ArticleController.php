<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;


class ArticleController extends Controller
{
    public function show(Article $article)
    {
        return ArticleResource::make($article);
    }

    public function index()
    {
        return ArticleCollection::make(Article::all());
    }
}
