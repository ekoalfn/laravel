<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('buku')->insert([
                'title' => $faker->sentence(3),
                'genre' => $faker->randomElement(['Fiction', 'Non-fiction', 'Fantasy', 'Sci-Fi', 'Mystery']),
                'author' => $faker->name,
                'price' => $faker->randomNumber(5, true),
            ]);
        }
    }
}
