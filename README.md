<p align="center">
  <a href="https://github.com/lyhtc/GoScore" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" width="400" alt="G-Scores Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/lyhtc/GoScore/actions"><img src="https://github.com/lyhtc/GoScore/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/laravel"><img src="https://img.shields.io/packagist/dt/laravel/laravel" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/laravel"><img src="https://img.shields.io/packagist/v/laravel/laravel" alt="Latest Stable Version"></a>
  <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="License"></a>
</p>

# G-Scores Dashboard

## Giới thiệu
G-Scores là một ứng dụng web giúp quản lý và phân tích kết quả kỳ thi THPT Quốc Gia 2024. Ứng dụng hỗ trợ nhập dữ liệu từ file CSV, tìm kiếm điểm số, hiển thị báo cáo thống kê và danh sách top học sinh theo khối A.

## Tính năng
- **Nhập dữ liệu**: Chuyển đổi dữ liệu từ file CSV vào cơ sở dữ liệu sử dụng Laravel Migration & Seeder.
- **Tra cứu điểm**: Tìm kiếm điểm của học sinh theo số báo danh.
- **Báo cáo thống kê**:
  - Phân loại học sinh theo 4 mức điểm:
    - `>= 8`
    - `6 - 7.9`
    - `4 - 5.9`
    - `< 4`
  - Hiển thị thống kê theo môn học bằng biểu đồ tương tác.
- **Top 10 học sinh khối A**:
  - Xếp hạng 10 học sinh có điểm cao nhất theo tổ hợp môn Toán, Lý, Hóa.

## Công nghệ sử dụng
- **Backend**: Laravel (PHP) với MySQL.
- **Frontend**: HTML, CSS, JavaScript (jQuery, Chart.js).
- **Cơ sở dữ liệu**: MySQL.

## Cài đặt và chạy dự án
### Yêu cầu hệ thống
- PHP >= 8.0
- Composer
- MySQL
- Node.js & npm

### Các bước cài đặt
```sh
# Clone repository
git clone https://github.com/lyhtc/GScore.git
cd GScore

# Cài đặt dependencies
composer install
npm install && npm run dev

# Cấu hình môi trường
cp .env.example .env
php artisan key:generate

# Cấu hình database
php artisan migrate

# Chạy dự án
php artisan serve
```
