<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;
use App\Models\Score;
use Illuminate\Support\Facades\Log;

class ScoreController extends Controller
{
    private $csvPath = 'storage/app/diem_thi_thpt_2024.csv';

    // Tìm kiếm điểm từ file CSV
    public function checkScore(Request $request)
    {
        $sbd = $request->input('sbd');

        if (!$sbd) {
            return response()->json(['error' => 'Vui lòng nhập số báo danh']);
        }

        $score = Score::where('sbd', $sbd)->first();

        if (!$score) {
            return response()->json(['error' => 'Không tìm thấy số báo danh']);
        }

        return response()->json([
            'scores' => $score->toArray()
        ]);
    }

    public function searchscores()
    {
        return view('searchscores');
    }

    public function report()
    {
        $csvPath = storage_path('app/diem_thi_thpt_2024.csv');

        if (!file_exists($csvPath)) {
            return view('report', ['error' => 'Không tìm thấy dữ liệu']);
        }

        $handle = fopen($csvPath, 'r');
        if (!$handle) {
            return view('report', ['error' => 'Không thể mở file CSV']);
        }

        $header = fgetcsv($handle);
        if (!$header) {
            fclose($handle);
            return view('report', ['error' => 'File CSV không hợp lệ']);
        }

        // Các môn cần thống kê
        $subjects = ['toan', 'ngu_van', 'ngoai_ngu', 'vat_li', 'hoa_hoc', 'sinh_hoc', 'lich_su', 'dia_li', 'gdcd'];
        $stats = array_fill_keys($subjects, [0, 0, 0, 0]);

        $students = [];

        while (($row = fgetcsv($handle)) !== false) {
            // Nếu số cột trong dòng không khớp với header, bỏ qua
            if (count($row) != count($header)) continue;

            $record = array_combine($header, $row);
            if (!$record) continue;

            foreach ($subjects as $subject) {
                if (!isset($record[$subject]) || $record[$subject] === '') continue;
                $score = floatval($record[$subject]);

                if ($score >= 8) $stats[$subject][0]++;
                elseif ($score >= 6) $stats[$subject][1]++;
                elseif ($score >= 4) $stats[$subject][2]++;
                else $stats[$subject][3]++;
            }

            if (!isset($record['sbd'])) continue;
            $sbd = $record['sbd'];
            $toan = isset($record['toan']) ? floatval($record['toan']) : 0;
            $vat_li = isset($record['vat_li']) ? floatval($record['vat_li']) : 0;
            $hoa_hoc = isset($record['hoa_hoc']) ? floatval($record['hoa_hoc']) : 0;
            $total = $toan + $vat_li + $hoa_hoc;

            $students[] = compact('sbd', 'toan', 'vat_li', 'hoa_hoc', 'total');
        }

        fclose($handle);

        // Top 10 học sinh khối A (Toán, Lý, Hóa)
        usort($students, fn($a, $b) => $b['total'] <=> $a['total']);
        $top10 = array_slice($students, 0, 10);

        return view('report', compact('stats', 'top10'));
    }

    public function show($id)
    {
        return view('score-detail', compact('id'));
    }

    public function setting()
    {
        return view('setting');
    }
}
