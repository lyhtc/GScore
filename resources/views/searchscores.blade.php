@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card p-4">
        <h4 class="fw-bold">User Registration</h4>
        <form id="scoreForm">
            @csrf
            <div class="mb-3">
                <label for="sbd" class="form-label">Registration Number:</label>
                <div class="d-flex">
                    <input type="text" class="form-control me-2" id="sbd" name="sbd" onkeyup="showLoading()" placeholder="Enter registration number">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
                <div id="loading" style="display: none;">Đang tải...</div>
            </div>
        </form>
    </div>

    <div class="card mt-3" id="score-container" style="display: none;">
        <div class="card-header"><strong>Detailed Scores</strong></div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Môn học</th>
                        <th>Điểm</th>
                    </tr>
                </thead>
                <tbody id="score-result">
                    <tr><td>Toán</td><td>-</td></tr>
                    <tr><td>Ngữ văn</td><td>-</td></tr>
                    <tr><td>Ngoại ngữ</td><td>-</td></tr>
                    <tr><td>Vật lý</td><td>-</td></tr>
                    <tr><td>Hóa học</td><td>-</td></tr>
                    <tr><td>Sinh học</td><td>-</td></tr>
                    <tr><td>Lịch sử</td><td>-</td></tr>
                    <tr><td>Địa lý</td><td>-</td></tr>
                    <tr><td>GDCD</td><td>-</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#scoreForm').submit(function(e) {
            e.preventDefault();

            var sbd = $('#sbd').val();
            if (sbd === '') {
                alert("Vui lòng nhập số báo danh");
                return;
            }

            $.ajax({
                url: "{{ route('check-score') }}",
                type: "POST",
                data: { _token: "{{ csrf_token() }}", sbd: sbd },
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        $('#score-container').hide();
                    } else {
                        var scores = response.scores;
                        var tableContent = `
                            <tr><td>Toán</td><td>${scores.toan ?? '0'}</td></tr>
                            <tr><td>Ngữ văn</td><td>${scores.ngu_van ?? '0'}</td></tr>
                            <tr><td>Ngoại ngữ</td><td>${scores.ngoai_ngu ?? '0'}</td></tr>
                            <tr><td>Vật lý</td><td>${scores.vat_li ?? '0'}</td></tr>
                            <tr><td>Hóa học</td><td>${scores.hoa_hoc ?? '0'}</td></tr>
                            <tr><td>Sinh học</td><td>${scores.sinh_hoc ?? '0'}</td></tr>
                            <tr><td>Lịch sử</td><td>${scores.lich_su ?? '0'}</td></tr>
                            <tr><td>Địa lý</td><td>${scores.dia_li ?? '0'}</td></tr>
                            <tr><td>GDCD</td><td>${scores.gdcd ?? '0'}</td></tr>
                        `;
                        $('#score-result').html(tableContent);
                        $('#score-container').show();
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                }
            });
        });
    });
</script>
@endsection
