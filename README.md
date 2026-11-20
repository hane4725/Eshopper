# 🛒 Eshopper - Website Bán Máy Tính & Linh Kiện PC (PHP MVC)

Website thương mại điện tử chuyên kinh doanh máy tính, linh kiện và phụ kiện công nghệ (PC Gaming, PC Văn Phòng, Màn hình, Bàn phím cơ, Chuột chơi game...). Được chuyển đổi và nâng cấp từ nền tảng ASP.NET Web Forms sang kiến trúc **PHP thuần theo mô hình MVC (Model - View - Controller)** kết nối **MySQL/MariaDB qua PDO Prepared Statements**.

---

## 🚀 Công Nghệ Sử Dụng

- **Ngôn ngữ:** PHP 8.x
- **Kiến trúc:** MVC (Model - View - Controller), Front-controller routing
- **Cơ sở dữ liệu:** MySQL / MariaDB (100% sử dụng PDO Prepared Statements chống SQL Injection)
- **Giao diện (Frontend):** HTML5, CSS3, JavaScript, Bootstrap 4, FontAwesome 5, jQuery
- **Môi trường chạy:** XAMPP (Apache + MySQL/MariaDB)

---

## ✨ Các Tính Năng Chính

### 🛍️ Phía Khách Hàng (Client)
- **Trang chủ:** Banner slider, danh mục nổi bật, sản phẩm mới nhất, sản phẩm giảm giá/bán chạy.
- **Xem & Lọc sản phẩm:** Lọc theo danh mục (PC, Bàn phím, Chuột, Màn hình), lọc theo thương hiệu, tìm kiếm từ khóa.
- **Chi tiết sản phẩm:** Xem thông số kỹ thuật chi tiết, bài viết đánh giá, đơn giá, tình trạng tồn kho, sản phẩm liên quan.
- **Giỏ hàng & Đặt hàng:** Thêm/sửa số lượng/xóa sản phẩm, tính tổng tiền tự động, hỗ trợ thanh toán khi nhận hàng (COD) hoặc chuyển khoản.
- **Tài khoản người dùng:** Đăng ký, đăng nhập bảo mật (mã hóa mật khẩu MD5), xem lịch sử các đơn hàng đã đặt và chi tiết đơn hàng.

### ⚙️ Phía Quản Trị Viên (Admin)
- **Bảng điều khiển:** Thống kê nhanh tổng số sản phẩm, đơn hàng, khách hàng, doanh thu.
- **Quản lý Hàng hóa:** Thêm mới, chỉnh sửa thông tin, giá bán, số lượng tồn kho, hình ảnh, xóa sản phẩm.
- **Quản lý Danh mục & Thương hiệu:** Quản lý linh hoạt danh mục sản phẩm và hãng sản xuất.
- **Quản lý Đơn hàng:** Xem danh sách đơn hàng, xem chi tiết sản phẩm khách đặt, cập nhật trạng thái đơn (Đang xử lý, Đang giao, Hoàn tất, Đã hủy).
- **Quản lý Người dùng & Phân quyền:** Danh sách tài khoản, cấp quyền hệ thống (Quản trị viên, Nhân viên, Khách hàng).

---

## 🛠️ Hướng Dẫn Cài Đặt & Chạy Thử

1. **Chuẩn bị môi trường:**
   - Cài đặt phần mềm **XAMPP** (hỗ trợ PHP 7.4 hoặc PHP 8.x).

2. **Đặt mã nguồn vào thư mục Webroot:**
   - Đặt toàn bộ thư mục dự án `Eshopper` vào thư mục:
     ```text
     C:\xampp\htdocs\Eshopper
     (hoặc đường dẫn XAMPP của bạn, ví dụ: E:\APP_LAPTRINH\xampp\htdocs\Eshopper)
     ```

3. **Nhập Cơ sở dữ liệu (Database):**
   - Mở trình duyệt và truy cập: `http://localhost/phpmyadmin/`
   - Tạo mới cơ sở dữ liệu tên là: **`webbanpc`** với bảng mã `utf8mb4_unicode_ci`.
   - Chọn database `webbanpc`, chọn thẻ **Import (Nhập)** và tải lên tệp:
     ```text
     webpc_mysql.sql
     ```
   - Nhấn **Import / Thực hiện** để hoàn tất.

4. **Cấu hình kết nối (Nếu cần thay đổi tài khoản MySQL):**
   - Tệp cấu hình nằm tại: `config/database.php`
   - Mặc định: `host = 'localhost'`, `port = '3306'`, `db_name = 'webbanpc'`, `username = 'root'`, `password = ''`.

5. **Khởi chạy ứng dụng:**
   - Bật **Apache** và **MySQL** trong **XAMPP Control Panel**.
   - Mở trình duyệt và truy cập:
     - **Trang bán hàng (Client):** `http://localhost/Eshopper/`
     - **Trang quản trị (Admin):** `http://localhost/Eshopper/admin/`

---

## 🔑 Tài Khoản Quản Trị Mặc Định

| Vai trò | Tên đăng nhập | Mật khẩu |
| :--- | :--- | :--- |
| **Quản Trị Viên (Admin)** | `Admin` | `1` |
| **Khách hàng mẫu** | `ourfather` | `123456` |

---

## 📂 Cấu Trúc Thư Mục

```text
Eshopper/
├── admin/              # Bộ điều khiển và giao diện trang Quản trị
├── config/             # Cấu hình Database và hằng số hệ thống
├── controllers/        # Bộ điều khiển phía Khách hàng
├── models/             # Lớp thao tác dữ liệu (PDO Prepared Statements)
├── views/              # Giao diện hiển thị (HTML/PHP)
├── includes/           # Header, Footer, Navbar dùng chung
├── css/ & js/ & lib/   # Tài nguyên tĩnh Frontend
├── webpc_mysql.sql     # Toàn bộ cấu trúc và dữ liệu CSDL mẫu
└── index.php           # Front-Controller điều phối ứng dụng
```
