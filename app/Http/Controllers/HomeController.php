<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Article::query()->withoutGlobalScope('userArticles')
            ->with(['category', 'user'])
            ->get();
        return view('home', compact('data'));
    }

    public function search(Request $request)
    {
        try {

            $data = Article::query()->withoutGlobalScope('userArticles')
                ->with(['category', 'user'])
                ->when($request->search, function ($q) use ($request) {
                    return $q->where('title', 'LIKE', '%' . $request->search . '%');
                })
                ->get();
            return view('home', compact('data'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $article = Article::query()->withoutGlobalScope('userArticles')
                ->with(['category', 'user'])->findOrFail($id);
            if ($article) {
                $article->update(['views' => $article->views + 1]);
                return view('show', compact('article'));
            }
            abort(404);

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
