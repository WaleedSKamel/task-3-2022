<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    protected function onCreate(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255', Rule::unique('categories', 'name')],
        ];
    }

    protected function onUpdate(): array
    {
        return [
            'id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'name' => ['required', 'string', 'min:2', 'max:255',
                Rule::unique('categories', 'name')->ignore($this->id, 'id')],
        ];
    }

    public function rules(): array
    {
        if (request()->routeIs('category.store')) {
            return $this->onCreate();
        } elseif (request()->routeIs('category.update')) {
            return $this->onUpdate();
        } else {
            return [];
        }
    }
}
