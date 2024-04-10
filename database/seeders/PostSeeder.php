<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $json = File::get('database/json/posts.json');

        $posts = collect(json_decode($json));

        $posts->each(function ($post) {

            Post::create([
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => $post->excerpt,
                'description' => $post->description,
                'is_published' => $post->is_published,
                'min_to_read' => $post->min_to_read,
            ]);
        });

        // $posts = collect([
        //     [
        //         'title' => 'Post One',
        //         'slug' => 'post-one',
        //         'excerpt' => 'Excerpt for post one.',
        //         'description' => 'Description for post one.',
        //         'is_published' => true,
        //         'min_to_read' => 2,
        //     ],
        //     [
        //         'title' => 'Post two',
        //         'slug' => 'post-two',
        //         'excerpt' => 'Excerpt for post two.',
        //         'description' => 'Description for post two.',
        //         'is_published' => true,
        //         'min_to_read' => 2,
        //     ]
        // ]);

        // $posts->each(function ($post) {
        //     // Post::insert($post);

        //     Post::create([
        //         'title' => $post['title'],
        //         'slug' => $post['slug'],
        //         'excerpt' => $post['excerpt'],
        //         'description' => $post['description'],
        //         'is_published' => $post['is_published'],
        //         'min_to_read' => $post['min_to_read'],
        //     ]);
        // });
    }
}
