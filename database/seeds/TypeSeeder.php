<?php

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'title' => 'Pizza',
            'user_id' => 1,
        ]);

        DB::table('types')->insert([
            'title' => 'Burger',
            'user_id' => 1,
        ]);

        DB::table('types')->insert([
            'title' => 'Pita',
            'user_id' => 1,
        ]);

        DB::table('types')->insert([
            'title' => 'Sandwich',
            'user_id' => 1,
        ]);

        DB::table('types')->insert([
            'title' => 'Pasta',
            'user_id' => 1,
        ]);
    }
}
