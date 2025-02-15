<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Score;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ScoreSeeder::class);

        // Tạo một user mặc định
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Đọc dữ liệu từ file CSV và chèn vào bảng scores
        $csvFile = public_path('diem_thi_thpt_2024.csv');

        if (!file_exists($csvFile)) {
            $this->command->error("File $csvFile không tồn tại!");
            return;
        }

        $file = fopen($csvFile, "r");
        $header = fgetcsv($file);

        while (($row = fgetcsv($file)) !== FALSE) {
            $data = array_combine($header, $row);

            Score::create([
                'sbd' => $data['sbd'],
                'toan' => !empty($data['toan']) ? $data['toan'] : null,
                'ngu_van' => !empty($data['ngu_van']) ? $data['ngu_van'] : null,
                'ngoai_ngu' => !empty($data['ngoai_ngu']) ? $data['ngoai_ngu'] : null,
                'vat_li' => !empty($data['vat_li']) ? $data['vat_li'] : null,
                'hoa_hoc' => !empty($data['hoa_hoc']) ? $data['hoa_hoc'] : null,
                'sinh_hoc' => !empty($data['sinh_hoc']) ? $data['sinh_hoc'] : null,
                'lich_su' => !empty($data['lich_su']) ? $data['lich_su'] : null,
                'dia_li' => !empty($data['dia_li']) ? $data['dia_li'] : null,
                'gdcd' => !empty($data['gdcd']) ? $data['gdcd'] : null,
                'ma_ngoai_ngu' => !empty($data['ma_ngoai_ngu']) ? $data['ma_ngoai_ngu'] : null,
            ]);
        }

        fclose($file);
        $this->command->info("Đã nhập dữ liệu từ CSV vào bảng scores!");
    }
}
