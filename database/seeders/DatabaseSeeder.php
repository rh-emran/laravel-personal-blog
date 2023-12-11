<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws \Exception
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'RH Emran',
             'email' => 'raihanulhaq@gmail.com',
         ]);

        Tag::factory()->count(20)->create();
        Category::factory()->count(20)->create();
        Article::factory()->count(50)->create();

        $articles = Article::all();
        $tags = Tag::all();

        // Attach random tags to each article
        $articles->each(function ($article) use ($tags) {
            $tagIds = $tags->random(random_int(1, 20))->pluck('id')->toArray();
            $article->tags()->attach($tagIds);
        });
    }
}
