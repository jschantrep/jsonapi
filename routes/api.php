<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;

Route::prefix('v1')->group(function () {
    Route::get('articles/{article}', [ArticleController::class, 'show'])
        ->name('api.v1.articles.show');
});
