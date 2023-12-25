<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Fake;

class InstationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Fake::create('id_ID');
        foreach(range(1,10) as $index){
            DB::table('instations')->insert([
                'name' => $faker->randomElement(['PT OTOMOTIF ', 'PT MAKANAN ', 'PT LOGISTIK ']) . $index,
                'address' => 'Kawasan Industri Blok ' . $index,
                'phone' => '0213000000 ' . $index,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
       }
    }
}
