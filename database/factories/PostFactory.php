<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $description = $this->faker->realText(200);
        $body = '<p>'.$this->faker->realText(2000);

        return [
            "title" => $title,
            "slug" => Str::slug($title),
            "description" => $description,
            "excerpt" => Str::words($description, 20, " ..."),
            "body" => json_encode($body),
            "user_id" => User::inRandomOrder()->first()->id,
            "featured_image" => "test-".rand(1,4).'.jpg',
            "category_id" => Category::inRandomOrder()->first()->id,
        ];
    }
}