<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(range(1, 100) as $user){
            $num = rand(1,4);
            DB::table('applies')->insert([
                'instation_id' => rand(1, 10),
                'user_id' => $user,
                'created_at' => Carbon::now()->addDay($num),
                'created_at' => Carbon::now()->addDay($num),
            ]);
        }
    }
}
