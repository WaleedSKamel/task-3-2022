<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    public function index()
    {
        try {
            $data = Article::query()->with(['category'])
                ->orderByDesc('created_at')->get();
            return view('backend.article.index', compact('data'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function categories()
    {
        return Category::query()->orderByDesc('created_at')->get();
    }


    public function create()
    {
        try {
            $edit = false;
            $categories = $this->categories();
            return view('backend.article.form', compact('edit', 'categories'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function store(ArticleRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = uploadFile([
                    'file' => 'image',
                    'path' => 'article',
                    'upload_type' => 'single',
                    'delete_file' => ''
                ]);
            }
            $article = Auth::user()->articles()->create($data);
            if ($article) {
                DB::commit();
                return redirect()->route('article.index')->with('success', 'Done Save Data Successfully');
            }
            deleteSingleFile($data['image']);
            return redirect()->back()->with('warning', 'Some failed errors')->withInput($request->all());
        } catch (\Exception $exception) {
            DB::rollBack();
            deleteSingleFile($data['image']);
            return redirect()->back()->with('error', $exception->getMessage())
                ->withInput($request->all());
        }
    }


    public function show(Article $article)
    {
        //
    }


    public function edit(Article $article)
    {
        try {
            $edit = true;
            $categories = $this->categories();
            return view('backend.article.form', compact('edit', 'article', 'categories'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function update(ArticleRequest $request, Article $article): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = uploadFile([
                    'file' => 'image',
                    'path' => 'article',
                    'upload_type' => 'single',
                    'delete_file' => $article->image
                ]);
            }
            if ($article->update($data)) {
                DB::commit();
                return redirect()->route('article.index')->with('success', 'Done Updated Data Successfully');
            }
            return redirect()->back()->with('warning', 'Some failed errors')->withInput($request->all());
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage())
                ->withInput($request->all());
        }
    }


    public function destroy(Article $article): \Illuminate\Http\RedirectResponse
    {
        try {
            $image = $article->image;
            DB::beginTransaction();
            if ($article->delete()) {
                DB::commit();
                Storage::delete($image);
                return redirect()->route('article.index')->with('success', 'Done Deleted Data Successfully');
            }
            return redirect()->back()->with('warning', 'Some failed errors');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
