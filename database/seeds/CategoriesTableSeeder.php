<?php

use Illuminate\Database\Seeder;
use TTEmpire\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            ['name' => 'Balls'],
            ['name' => 'Rackets'],
            ['name' => 'Rubbers'],
            ['name' => 'Booster/Tuner'],
        ]);
    }
}
