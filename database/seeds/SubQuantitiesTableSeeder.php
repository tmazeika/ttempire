<?php

use Illuminate\Database\Seeder;
use TTEmpire\SubQuantity;

class SubQuantitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubQuantity::insert([
           [
               'product_id' => 1,
               'quantity' => 100,
               'eur_price' => 4000,
               'usd_price' => 4200,
           ],
           [
               'product_id' => 1,
               'quantity' => 500,
               'eur_price' => 19000,
               'usd_price' => 20100,
           ],
           [
               'product_id' => 1,
               'quantity' => 1000,
               'eur_price' => 37000,
               'usd_price' => 39200,
           ],
           [
               'product_id' => 1,
               'quantity' => 1500,
               'eur_price' => 52500,
               'usd_price' => 55700,
           ],
           [
               'product_id' => 2,
               'quantity' => 48,
               'eur_price' => 5200,
               'usd_price' => 5500,
           ],
           [
               'product_id' => 2,
               'quantity' => 120,
               'eur_price' => 12000,
               'usd_price' => 12700,
           ],
           [
               'product_id' => 2,
               'quantity' => 300,
               'eur_price' => 29400,
               'usd_price' => 31100,
           ],
           [
               'product_id' => 3,
               'quantity' => 80,
               'eur_price' => 4600,
               'usd_price' => 4900,
           ],
           [
               'product_id' => 3,
               'quantity' => 200,
               'eur_price' => 10500,
               'usd_price' => 11200,
           ],
           [
               'product_id' => 3,
               'quantity' => 500,
               'eur_price' => 24000,
               'usd_price' => 25600,
           ],
           [
               'product_id' => 4,
               'quantity' => 48,
               'eur_price' => 4500,
               'usd_price' => 4800,
           ],
           [
               'product_id' => 4,
               'quantity' => 120,
               'eur_price' => 10500,
               'usd_price' => 11200,
           ],
           [
               'product_id' => 4,
               'quantity' => 300,
               'eur_price' => 24000,
               'usd_price' => 25600,
           ],
           [
               'product_id' => 5,
               'quantity' => 1,
               'eur_price' => 2000,
               'usd_price' => 2200,
           ],
           [
               'product_id' => 6,
               'quantity' => 1,
               'eur_price' => 2600,
               'usd_price' => 2800,
           ],
           [
               'product_id' => 7,
               'quantity' => 1,
               'eur_price' => 2400,
               'usd_price' => 2600,
           ],
           [
               'product_id' => 8,
               'quantity' => 1,
               'eur_price' => 3700,
               'usd_price' => 3900,
           ],
           [
               'product_id' => 9,
               'quantity' => 1,
               'eur_price' => 2700,
               'usd_price' => 2900,
           ],
           [
               'product_id' => 10,
               'quantity' => 1,
               'eur_price' => 3700,
               'usd_price' => 3900,
           ],
        ]);
    }
}
