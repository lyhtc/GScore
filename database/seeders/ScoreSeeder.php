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
            DB::table('scores')->updateOrInsert(
                ['sbd' => $data[0]], // Điều kiện kiểm tra trùng
                [
                    'toan' => is_numeric($data[1]) ? $data[1] : '0',
                    'ngu_van' => is_numeric($data[2]) ? $data[2] : '0',
                    'ngoai_ngu' => is_numeric($data[3]) ? $data[3] : '0',
                    'vat_li' => is_numeric($data[4]) ? $data[4] : '0',
                    'hoa_hoc' => is_numeric($data[5]) ? $data[5] : '0',
                    'sinh_hoc' => is_numeric($data[6]) ? $data[6] : '0',
                    'lich_su' => is_numeric($data[7]) ? $data[7] : '0',
                    'dia_li' => is_numeric($data[8]) ? $data[8] : '0',
                    'gdcd' => is_numeric($data[9]) ? $data[9] : '0',
                    'ma_ngoai_ngu' => $data[10] ?? 0,
                ]
            );
        }
        fclose($file);
        }
}
