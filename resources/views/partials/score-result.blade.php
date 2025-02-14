@if($scores)
    <table class="table table-bordered">
        <tr>
            <th>Subject</th>
            <th>Score</th>
        </tr>
        <tr><td>Toán</td><td>{{ $scores['toan'] ?? 'N/A' }}</td></tr>
        <tr><td>Ngữ Văn</td><td>{{ $scores['ngu_van'] ?? 'N/A' }}</td></tr>
        <tr><td>Ngoại Ngữ</td><td>{{ $scores['ngoai_ngu'] ?? 'N/A' }}</td></tr>
        <tr><td>Vật Lý</td><td>{{ $scores['vat_li'] ?? 'N/A' }}</td></tr>
        <tr><td>Hóa Học</td><td>{{ $scores['hoa_hoc'] ?? 'N/A' }}</td></tr>
        <tr><td>Sinh Học</td><td>{{ $scores['sinh_hoc'] ?? 'N/A' }}</td></tr>
        <tr><td>Lịch Sử</td><td>{{ $scores['lich_su'] ?? 'N/A' }}</td></tr>
        <tr><td>Địa Lý</td><td>{{ $scores['dia_li'] ?? 'N/A' }}</td></tr>
        <tr><td>GDCD</td><td>{{ $scores['gdcd'] ?? 'N/A' }}</td></tr>
        <tr><td>Mã Ngoại Ngữ</td><td>{{ $scores['ma_ngoai_ngu'] ?? 'N/A' }}</td></tr>
    </table>
@else
    <p>Không tìm thấy kết quả</p>
@endif
