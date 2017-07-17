<?php

use Illuminate\Database\Seeder;

class RestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('restaurants')->insert([
            'name' => 'Dragon Grill',
            'type' => 1,
            'lat' => '55.618900599999996',
            'lng' => '12.6118056'
        ]);


        DB::table('restaurants')->insert([
            'name' => 'Sehers 2',
            'type' => 1,
            'lat' => '55.618900599999996',
            'lng' => '12.6118056'
        ]);


        DB::table('restaurants')->insert([
            'name' => 'KFC',
            'type' => 1,
            'lat' => '55.618900599999996',
            'lng' => '12.6118056'
        ]);
    }
}
