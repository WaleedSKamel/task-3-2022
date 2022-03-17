<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $data = Category::query()->orderByDesc('created_at')->get();
            return view('backend.category.index', compact('data'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function create()
    {
        try {
            $edit = false;
            return view('backend.category.form', compact('edit'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function store(CategoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $category = Category::query()->create($data);
            if ($category) {
                DB::commit();
                return redirect()->route('category.index')->with('success', 'Done Save Data Successfully');
            }
            return redirect()->back()->with('warning', 'Some failed errors')->withInput($request->all());
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage())
                ->withInput($request->all());
        }
    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        try {
            $edit = true;
            return view('backend.category.form', compact('edit', 'category'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function update(CategoryRequest $request, Category $category): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($category->update($data)) {
                DB::commit();
                return redirect()->route('category.index')->with('success', 'Done Updated Data Successfully');
            }
            return redirect()->back()->with('warning', 'Some failed errors')->withInput($request->all());
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage())
                ->withInput($request->all());
        }
    }


    public function destroy(Category $category): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            if ($category->delete()) {
                DB::commit();
                return redirect()->route('category.index')->with('success', 'Done Deleted Data Successfully');
            }
            return redirect()->back()->with('warning', 'Some failed errors');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
