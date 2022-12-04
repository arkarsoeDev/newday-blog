<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\Tag;
use App\Models\TagPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            CountrySeeder::class,
            PostViewSeeder::class,
        ]);

        $length = 100;
        for($i=1;$i<=$length;$i++) {
            $tag = rand(1,4);
            TagPost::create([
                'post_id' => $i,
                'tag_id' => $tag,
            ]);
            if($tag == 4) {
                $tag--;
            } else {
                $tag++;
            }
            TagPost::create([
                'post_id' => $i,
                'tag_id' => $tag,
            ]);
        }

        $photos = Storage::allFiles('public');
        array_shift($photos);
        Storage::delete($photos);

        $directories = Storage::allDirectories('public');
        foreach($directories as $d) {
            Storage::deleteDirectory($d);
        }

        echo "\e[93nStorage Cleaned \n";
    }
}