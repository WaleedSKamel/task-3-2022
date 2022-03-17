<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('categories',[HomeController::class,'categories']);
Route::get('articles-by-category-id/{id}',[HomeController::class,'articlesByCategoryId']);
Route::post('article/show/{id}',[HomeController::class,'article']);
