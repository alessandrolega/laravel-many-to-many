<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Facebook',
            'Instagram',
            'Twitter',
            'Telegram'
        ];

        foreach($categories as $category){
            $new_category = new Category();
            $new_category->name = $category;
            $new_category->save();

        }
    }
}
