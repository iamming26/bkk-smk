<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Fake;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\table;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Fake::create('id_ID');
        foreach(range(1, 10) as $index){
            DB::table('jobs')->insert([
                'instation_id' => $index,
                'desc' => '<ol><li>Pria atau Wanita</li><li>Pendidikan SMA (Khusus IPA) & SMK (Semua Jurusan)</li><li>Usia 18 tahun - 28 tahun</li><li>TB minimal (Pria: 160 & Wanita: 155)</li><li>Berat badan proporsional</li><li>Sudah Vaksin Booster</li><li>Sehat Mata</li></ol>',
                'position' => $faker->randomElement(['Operator Produksi', 'Admin PPIC', 'QC Inspection', 'Checker']),
                'start' => Carbon::now()->format('Y-m-d'),
                'end' => Carbon::now()->addDay(5, 10)->format('Y-m-d'),
                'selection' => $faker->randomElement([Carbon::now()->addDay(5, 10)->format('Y-m-d'), null]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
