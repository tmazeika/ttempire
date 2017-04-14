<?php

use Illuminate\Database\Seeder;
use TTEmpire\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'category_id' => 1,
                'title' => 'Kingnik 1-Star',
                'slug' => str_slug('Kingnik 1-Star'),
                'description' => 'Plastic super training.',
            ],
            [
                'category_id' => 1,
                'title' => 'Kingnik 3-Star',
                'slug' => str_slug('Kingnik 3-Star'),
                'description' => 'ITTF approved, seamless.',
            ],
            [
                'category_id' => 1,
                'title' => 'DHS 2-Star',
                'slug' => str_slug('DHS 2-Star'),
                'description' => 'DHS 2-Star',
            ],
            [
                'category_id' => 1,
                'title' => 'DHS 3-Star',
                'slug' => str_slug('DHS 3-Star'),
                'description' => 'DHS 3-Star',
            ],
            [
                'category_id' => 2,
                'title' => 'TTEmpire Allround Racket',
                'slug' => str_slug('TTEmpire Allround Racket'),
                'description' => 'Three swords rubbers and XJP wood blade.',
            ],
            [
                'category_id' => 2,
                'title' => 'TTEmpire Offensive Racket',
                'slug' => str_slug('TTEmpire Offensive Racket'),
                'description' => 'Three swords rubbers and XJP wood blade.',
            ],
            [
                'category_id' => 3,
                'title' => 'Neo Hurricane 3',
                'slug' => str_slug('Neo Hurricane 3'),
                'description' => 'Neo Hurricane 3',
            ],
            [
                'category_id' => 3,
                'title' => 'Neo Hurricane 3 Provincial Edition',
                'slug' => str_slug('Neo Hurricane 3 Provincial Edition'),
                'description' => 'With orange sponge.',
            ],
            [
                'category_id' => 3,
                'title' => 'Neo Hurricane 3-50',
                'slug' => str_slug('Neo Hurricane 3-50'),
                'description' => 'Neo Hurricane 3-50',
            ],
            [
                'category_id' => 4,
                'title' => 'Seamoon 250mL',
                'slug' => str_slug('Seamoon 250mL'),
                'description' => 'Seamoon 250mL',
            ],
        ]);
    }
}
