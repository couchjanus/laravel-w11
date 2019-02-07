<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriesData = array(
            array('name' => 'artisan'),
            array('name' => 'php'),
            array('name' => 'laravel'),
        );

        // Удаляем предыдущие данные
 
        DB::table('categories')->delete();

        foreach ($categoriesData as $cat) {
          DB::table('categories')->insert([
                'name' => $cat['name'], 
                'description' => str_random(100)
            ]);
        }
        // DB::table('categories')->insert([
        //     'name' => str_random(10),
        //     'description' => str_random(100)
        //     ]); 
    }
}
