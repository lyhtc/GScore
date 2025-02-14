document.addEventListener("DOMContentLoaded", function () {
    //Xử lý tải nội dung động khi click sidebar
    document.querySelectorAll(".sidebar a").forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();

            let url = this.getAttribute("href");

            fetch(url, {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
            .then(response => response.json())
            .then(data => {
                if (!data || !data.html) {
                    console.error("Lỗi: Dữ liệu tải về không hợp lệ", data);
                    document.querySelector(".content").innerHTML = "<p>Lỗi tải trang.</p>";
                    return;
                }
                document.querySelector(".content").innerHTML = data.html;

                // Tải dữ liệu và vẽ biểu đồ /report
                if (url.includes("report")) {
                    loadReportData();
                }
            })
            .catch(error => console.error("Lỗi tải trang:", error));
        });
    });

    //Tra cứu điểm bằng AJAX
    $(document).ready(function () {
        $('#scoreForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "/check-score",
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    if (!response || !response.html) {
                        $('#result').html('<p>Lỗi tải kết quả.</p>');
                        return;
                    }
                    $('#result').html(response.html);
                },
                error: function () {
                    $('#result').html('<p>Error occurred!</p>');
                }
            });
        });
    });

    //Load dữ liệu báo cáo từ API và hiển thị biểu đồ
    function loadReportData() {
        fetch('/report-data', {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => response.json())
        .then(data => {
            if (!data || !data.statistics || !data.top10) {
                console.error("Lỗi dữ liệu report:", data);
                document.querySelector(".content").innerHTML = "<p>Lỗi tải báo cáo.</p>";
                return;
            }

            //Top 10 học sinh khối A
            let top10Html = "<h3>Top 10 học sinh khối A</h3><ul>";
            data.top10.forEach(student => {
                top10Html += `<li>SBD: ${student.sbd} - Tổng điểm: ${student.total}</li>`;
            });
            top10Html += "</ul>";
            document.querySelector("#top10").innerHTML = top10Html;

            //Biểu đồ thống kê từng môn học
            let ctx = document.getElementById("reportChart");
            if (ctx) {
                let labels = Object.keys(data.statistics);
                let datasets = [
                    { label: ">=8", backgroundColor: "green", data: labels.map(subj => data.statistics[subj][">=8"]) },
                    { label: "6 - 7.9", backgroundColor: "blue", data: labels.map(subj => data.statistics[subj]["6 - 7.9"]) },
                    { label: "4 - 5.9", backgroundColor: "orange", data: labels.map(subj => data.statistics[subj]["4 - 5.9"]) },
                    { label: "<4", backgroundColor: "red", data: labels.map(subj => data.statistics[subj]["<4"]) }
                ];

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        scales: { y: { beginAtZero: true } }
                    }
                });
            } else {
                console.warn("Không tìm thấy phần tử canvas #reportChart.");
            }
        })
        .catch(error => console.error("Lỗi tải báo cáo:", error));
    }
});
