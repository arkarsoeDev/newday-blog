<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ["Phone","Health","Knowledge","Tech","Advice"];

        foreach ($tags as $tag) {
            Tag::create([
                "title" => $tag,
                "slug" => Str::slug($tag),
                "user_id" => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
