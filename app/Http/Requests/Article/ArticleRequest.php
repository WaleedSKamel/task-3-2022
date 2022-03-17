<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    protected function onData(): array
    {
        return [
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['required', 'string', 'min:2', 'max:255'],
        ];
    }

    protected function onCreate(): array
    {
        return array_merge($this->onData(), [
            'image' => ['required', validationImage()],
        ]);
    }

    protected function onUpdate(): array
    {
        return array_merge($this->onData(), [
            'id' => ['required', 'integer', Rule::exists('articles', 'id')],
            'image' => ['nullable', validationImage()],
        ]);
    }

    public function rules(): array
    {
        if (request()->routeIs('article.store')) {
            return $this->onCreate();
        } elseif (request()->routeIs('article.update')) {
            return $this->onUpdate();
        } else {
            return [];
        }
    }
}
