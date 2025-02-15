<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ini_set('default_charset', 'UTF-8');
        $file = fopen(public_path('diem_thi_thpt_2024.csv'), 'r');
        $header = fgetcsv($file);
        while (($data = fgetcsv($file)) !== FALSE) {
            DB::table('scores')->insert([
                'sbd' => $data[0],
                'toan' => is_numeric($data[1]) ? $data[1] : null,
                'ngu_van' => is_numeric($data[2]) ? $data[2] : null,
                'ngoai_ngu' => is_numeric($data[3]) ? $data[3] : null,
                'vat_li' => is_numeric($data[4]) ? $data[4] : null,
                'hoa_hoc' => is_numeric($data[5]) ? $data[5] : null,
                'sinh_hoc' => is_numeric($data[6]) ? $data[6] : null,
                'lich_su' => is_numeric($data[7]) ? $data[7] : null,
                'dia_li' => is_numeric($data[8]) ? $data[8] : null,
                'gdcd' => is_numeric($data[9]) ? $data[9] : null,
                'ma_ngoai_ngu' => $data[10] ?? null,
            ]);
        }
        fclose($file);
        }
}
