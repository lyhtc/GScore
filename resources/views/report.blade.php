@extends('layout')

@section('content')
<div class="container">
    <h2 class="fw-bold my-3">Thống kê điểm số</h2>

    @if(isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
    @else
        <div class="card p-3">
            <canvas id="scoreChart"></canvas>
        </div>

        <h2 class="fw-bold my-4">Top 10 học sinh khối A</h2>
        <div class="card p-3">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Hạng</th>
                        <th>Số báo danh</th>
                        <th>Toán</th>
                        <th>Vật lý</th>
                        <th>Hóa học</th>
                        <th>Tổng điểm</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($top10 as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student['sbd'] }}</td>
                            <td>{{ $student['toan'] ?? '-' }}</td>
                            <td>{{ $student['vat_li'] ?? '-' }}</td>
                            <td>{{ $student['hoa_hoc'] ?? '-' }}</td>
                            <td>{{ $student['total'] ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    @if(!isset($error) && !empty($stats))
        const stats = @json($stats);
        const labels = Object.keys(stats);
        const values = Object.values(stats);

        const datasets = [
            { label: ">=8", backgroundColor: "green", data: values.map(v => v[0] || 0) },
            { label: "6 - 7.9", backgroundColor: "blue", data: values.map(v => v[1] || 0) },
            { label: "4 - 5.9", backgroundColor: "orange", data: values.map(v => v[2] || 0) },
            { label: "<4", backgroundColor: "red", data: values.map(v => v[3] || 0) }
        ];

        new Chart(document.getElementById("scoreChart"), {
            type: "bar",
            data: { labels, datasets },
            options: {
                responsive: true,
                plugins: { legend: { position: "top" } },
                scales: { y: { beginAtZero: true } }
            }
        });
    @endif
});
</script>
@endsection
