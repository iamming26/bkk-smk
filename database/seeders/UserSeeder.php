<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(range(1, 100) as $i){
            DB::table('users')->insert([
                'name' => 'Nama Jobseeker ' . $i,
                'email' => $i . '@email.com',
                'password' => Hash::make($i),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::table('user_details')->insert([
                'user_id' => $i,
            ]);
        }

        DB::table('users')->insert([
            'name' => 'ADMIN 1',
            'email' => 'admin1@email.com',
            'password' => Hash::make('1'),
            'type' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'ADMIN 2',
            'email' => 'admin2@email.com',
            'type' => 1,
            'password' => Hash::make('2'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_details')->insert([
            'user_id' => 101,
        ]);

        DB::table('user_details')->insert([
            'user_id' => 102,
        ]);
        
        DB::table('users')->insert([
            'name' => 'recruiter 1',
            'email' => 'recruiter1@email.com',
            'password' => Hash::make('1'),
            'type' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'recruiter 2',
            'email' => 'recruiter2@email.com',
            'type' => 2,
            'password' => Hash::make('2'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_details')->insert([
            'user_id' => 103,
            'instation_id' => 1,
        ]);

        DB::table('user_details')->insert([
            'user_id' => 104,
            'instation_id' => 1,
        ]);

    }
}
