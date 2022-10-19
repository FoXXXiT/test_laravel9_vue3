<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

        Language::all()->each(function (Language $language) {
            Post::factory()
                ->has(
                    PostTranslation::factory()->state(function (array $attributes, Post $post) use ($language) {
                        return [
                            'post_id' => $post->id,
                            'language_id' => $language->id,
                        ];
                    }),
                    'translations'
                )
                ->create();
        });

    }

}
