<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostView>
 */
class PostViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $post = Post::inRandomOrder()->first();
        return [
            'post_id' => $post->id,
            'country_id' => Country::inRandomOrder()->first()->id,
            'slug' => $post->slug,
            'url' => 'http://127.0.0.1:8000/posts/'.$post->slug,
            'session_id' => '1122',
            'user_id' => User::inRandomOrder()->first()->id,
            'ip' => 'testip',
            'agent' => 'testagent'
        ];
    }
}
