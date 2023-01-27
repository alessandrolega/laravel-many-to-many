<?php

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i < 100; $i++){
            $new_post = new Post();
            $new_post->title = $faker->words(5,true);
            $new_post->body = $faker->text();
            $new_post->save();
        }
    }
}
