<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement(User::query()->pluck('id')->toArray()),
            'category_id' => $this->faker->randomElement(Category::query()->pluck('id')->toArray()),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
        ];
    }
}
