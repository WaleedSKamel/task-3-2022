<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseTrait;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Models\Article;

class HomeController extends Controller
{
    use ApiResponseTrait;

    public function categories(): \Illuminate\Http\JsonResponse
    {
        $categories = new ArticleController();
        return $this->apiResponse(CategoryResource::collection($categories->categories()), '');
    }

    public function articlesByCategoryId($id): \Illuminate\Http\JsonResponse
    {
        $articles = Article::query()->withoutGlobalScope('userArticles')
            ->where('category_id', '=', $id)
            ->orderByDesc('created_at')->get();
        return $this->apiResponse(ArticleResource::collection($articles), '');
    }

    public function article($id): \Illuminate\Http\JsonResponse
    {
        $article = Article::query()->withoutGlobalScope('userArticles')->find($id);
        if ($article) {
            $article->update(['views' => $article->views + 1]);
            return $this->apiResponse(ArticleResource::make($article));
        }
        return $this->notFound();
    }
}
