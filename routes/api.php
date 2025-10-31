<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;

Route::prefix('v1')->group(function () {
    Route::get('articles/{article}', [ArticleController::class, 'show'])
        ->name('api.v1.articles.show');
});

Route::prefix('v1')->group(function () {
    Route::get('articles', [ArticleController::class, 'index'])
        ->name('api.v1.articles.index');
});
