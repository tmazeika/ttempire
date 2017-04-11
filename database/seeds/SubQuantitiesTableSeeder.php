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
               'usd_price' => 4200,
               'eur_price' => 4000,
           ],
           [
               'product_id' => 1,
               'quantity' => 500,
               'usd_price' => 20100,
               'eur_price' => 19000,
           ],
           [
               'product_id' => 1,
               'quantity' => 1000,
               'usd_price' => 39200,
               'eur_price' => 37000,
           ],
           [
               'product_id' => 1,
               'quantity' => 1500,
               'usd_price' => 39200,
               'eur_price' => 52500,
           ],
           [
               'product_id' => 2,
               'quantity' => 48,
               'usd_price' => 5500,
               'eur_price' => 5200,
           ],
           [
               'product_id' => 2,
               'quantity' => 120,
               'usd_price' => 12700,
               'eur_price' => 12000,
           ],
           [
               'product_id' => 2,
               'quantity' => 300,
               'usd_price' => 31100,
               'eur_price' => 29400,
           ],
           [
               'product_id' => 3,
               'quantity' => 80,
               'usd_price' => 4900,
               'eur_price' => 4600,
           ],
           [
               'product_id' => 3,
               'quantity' => 200,
               'usd_price' => 11200,
               'eur_price' => 10500,
           ],
           [
               'product_id' => 3,
               'quantity' => 500,
               'usd_price' => 25600,
               'eur_price' => 24000,
           ],
           [
               'product_id' => 4,
               'quantity' => 48,
               'usd_price' => 4800,
               'eur_price' => 4500,
           ],
           [
               'product_id' => 4,
               'quantity' => 120,
               'usd_price' => 11200,
               'eur_price' => 10500,
           ],
           [
               'product_id' => 4,
               'quantity' => 300,
               'usd_price' => 25600,
               'eur_price' => 24000,
           ],
           [
               'product_id' => 5,
               'quantity' => 1,
               'usd_price' => 2200,
               'eur_price' => 2000,
           ],
           [
               'product_id' => 6,
               'quantity' => 1,
               'usd_price' => 2800,
               'eur_price' => 2600,
           ],
           [
               'product_id' => 7,
               'quantity' => 1,
               'usd_price' => 2600,
               'eur_price' => 2400,
           ],
           [
               'product_id' => 8,
               'quantity' => 1,
               'usd_price' => 3900,
               'eur_price' => 3700,
           ],
           [
               'product_id' => 9,
               'quantity' => 1,
               'usd_price' => 2900,
               'eur_price' => 2700,
           ],
           [
               'product_id' => 10,
               'quantity' => 1,
               'usd_price' => 3900,
               'eur_price' => 3700,
           ],
        ]);
    }
}
