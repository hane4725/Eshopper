-- ==========================================================
-- CƠ SỞ DỮ LIỆU TEST CHO DỰ ÁN ESHOPPER (PHP & MySQL)
-- ==========================================================

CREATE DATABASE IF NOT EXISTS `webbanpc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `webbanpc`;

SET FOREIGN_KEY_CHECKS = 0;

-- 1. Bảng Danh Mục Sản Phẩm (DanhMuc)
DROP TABLE IF EXISTS `danhmuc`;
CREATE TABLE `danhmuc` (
    `CategoryID` INT AUTO_INCREMENT PRIMARY KEY,
    `TenDanhMuc` VARCHAR(255) NOT NULL,
    `AnhDM` VARCHAR(500) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Bảng Hãng Sản Xuất (HangSanXuat)
DROP TABLE IF EXISTS `hangsanxuat`;
CREATE TABLE `hangsanxuat` (
    `BrandID` INT AUTO_INCREMENT PRIMARY KEY,
    `TenHang` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Bảng Người Dùng / Thành Viên (NguoiDung)
DROP TABLE IF EXISTS `nguoidung`;
CREATE TABLE `nguoidung` (
    `Username` VARCHAR(50) PRIMARY KEY,
    `Matkhau` VARCHAR(32) NOT NULL COMMENT 'Chuỗi mã hóa MD5 viết hoa',
    `HoTen` VARCHAR(150) NULL,
    `SoDienThoai` VARCHAR(20) NULL,
    `Email` VARCHAR(150) NULL,
    `DiaChi` VARCHAR(255) NULL,
    `Quyen` INT DEFAULT 1 COMMENT '0: Admin, 1: Khách hàng, 2: Nhân viên'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Bảng Sản Phẩm (SanPham)
DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE `sanpham` (
    `ProductID` INT AUTO_INCREMENT PRIMARY KEY,
    `TenSanPham` VARCHAR(255) NOT NULL,
    `Gia` DECIMAL(15, 0) NOT NULL DEFAULT 0,
    `HinhAnh` VARCHAR(500) NULL,
    `MoTa` LONGTEXT NULL,
    `ThongSoKyThuat` LONGTEXT NULL,
    `SoLuongTon` INT NOT NULL DEFAULT 0,
    `BrandID` INT DEFAULT 0 COMMENT '0: PC (không dùng hãng), >0: ID hãng',
    `CategoryID` INT NOT NULL,
    CONSTRAINT `fk_sp_danhmuc` FOREIGN KEY (`CategoryID`) REFERENCES `danhmuc` (`CategoryID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Bảng Giỏ Hàng (GioHang - Lưu theo Username của khách)
DROP TABLE IF EXISTS `giohang`;
CREATE TABLE `giohang` (
    `CartID` INT AUTO_INCREMENT PRIMARY KEY,
    `Username` VARCHAR(50) NOT NULL,
    `ProductID` INT NOT NULL,
    `SoLuong` INT NOT NULL DEFAULT 1,
    CONSTRAINT `fk_gh_user` FOREIGN KEY (`Username`) REFERENCES `nguoidung` (`Username`) ON DELETE CASCADE,
    CONSTRAINT `fk_gh_sp` FOREIGN KEY (`ProductID`) REFERENCES `sanpham` (`ProductID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Bảng Đơn Hàng (DonHang)
DROP TABLE IF EXISTS `donhang`;
CREATE TABLE `donhang` (
    `OrderID` INT AUTO_INCREMENT PRIMARY KEY,
    `Username` VARCHAR(50) NOT NULL,
    `HoTen` VARCHAR(150) NOT NULL,
    `SoDienThoai` VARCHAR(20) NOT NULL,
    `DiaChi` VARCHAR(255) NOT NULL,
    `TongTien` DECIMAL(15, 0) NOT NULL,
    `PhuongThuc` VARCHAR(50) NOT NULL DEFAULT 'COD',
    `TrangThai` INT NOT NULL DEFAULT 0 COMMENT '0: Đang xử lý, 1: Đang giao, 2: Hoàn thành, 3: Đã hủy',
    `NgayDat` DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_dh_user` FOREIGN KEY (`Username`) REFERENCES `nguoidung` (`Username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Bảng Chi Tiết Đơn Hàng (ChiTietDonHang)
DROP TABLE IF EXISTS `chitietdonhang`;
CREATE TABLE `chitietdonhang` (
    `OrderDetailID` INT AUTO_INCREMENT PRIMARY KEY,
    `OrderID` INT NOT NULL,
    `ProductID` INT NOT NULL,
    `SoLuong` INT NOT NULL DEFAULT 1,
    `DonGia` DECIMAL(15, 0) NOT NULL,
    `ThanhTien` DECIMAL(15, 0) NOT NULL,
    CONSTRAINT `fk_ct_dh` FOREIGN KEY (`OrderID`) REFERENCES `donhang` (`OrderID`) ON DELETE CASCADE,
    CONSTRAINT `fk_ct_sp` FOREIGN KEY (`ProductID`) REFERENCES `sanpham` (`ProductID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- ==========================================================
-- DỮ LIỆU MẪU (TEST DATA)
-- ==========================================================

-- 1. Thêm người dùng mẫu
-- Mật khẩu "1" -> MD5 là "C4CA4238A0B923820DCC509A6F75849B"
-- Mật khẩu "123456" -> MD5 là "E10ADC3949BA59ABBE56E057F20F883E"
INSERT INTO `nguoidung` (`Username`, `Matkhau`, `HoTen`, `SoDienThoai`, `Email`, `DiaChi`, `Quyen`) VALUES
('Admin', 'C4CA4238A0B923820DCC509A6F75849B', 'Quản Trị Viên', '0868097351', 'admin@eshopper.vn', 'Hạ Long, Quảng Ninh', 0),
('nhanvien', 'E10ADC3949BA59ABBE56E057F20F883E', 'Nhân Viên Bán Hàng', '0912345678', 'nhanvien@eshopper.vn', 'Hà Nội', 2),
('khachhang', 'E10ADC3949BA59ABBE56E057F20F883E', 'Nguyễn Văn Khách', '0987654321', 'khachhang@gmail.com', 'Hải Phòng', 1);

-- 2. Thêm Danh mục mẫu (ID 1 đến 5 theo đúng quy ước trong code cũ)
INSERT INTO `danhmuc` (`CategoryID`, `TenDanhMuc`, `AnhDM`) VALUES
(1, 'PC Văn Phòng', 'Banner/banner_pc_vanphong.jpg'),
(2, 'PC Gaming', 'Banner/banner_pc_gaming.jpg'),
(3, 'Bàn Phím', 'Banner/banner_banphim.jpg'),
(4, 'Màn Hình', 'Banner/banner_manhinh.jpg'),
(5, 'Chuột', 'Banner/banner_chuot.jpg');

-- 3. Thêm Hãng sản xuất mẫu
INSERT INTO `hangsanxuat` (`BrandID`, `TenHang`) VALUES
(1, 'Logitech'),
(2, 'Razer'),
(3, 'Corsair'),
(4, 'ASUS'),
(5, 'Dell'),
(6, 'Samsung');

-- 4. Thêm Sản phẩm mẫu
INSERT INTO `sanpham` (`ProductID`, `TenSanPham`, `Gia`, `HinhAnh`, `MoTa`, `ThongSoKyThuat`, `SoLuongTon`, `BrandID`, `CategoryID`) VALUES
(1, 'PC Gaming Core i5 12400F / RTX 3060', 16500000, 'img2/PC_gaming/pc_gaming_1/pc_gaming_1.jpg', '<p>Dàn PC Gaming cân tốt mọi tựa game AAA hiện nay.</p>', '<p>CPU: i5 12400F<br>RAM: 16GB DDR4<br>VGA: RTX 3060 12GB<br>SSD: NVMe 500GB</p>', 15, 0, 2),
(2, 'PC Văn Phòng Core i3 12100 / RAM 8GB', 7800000, 'img2/PC_vanphong/pc_vanphong_1/pc_vanphong_1.jpg', '<p>Bộ máy tính văn phòng nhỏ gọn, mượt mà các tác vụ tin học.</p>', '<p>CPU: i3 12100<br>RAM: 8GB DDR4<br>SSD: 256GB SSD</p>', 20, 0, 1),
(3, 'Bàn Phím Cơ Logitech G Pro X', 2490000, 'Banphim/banphim_1/banphim_1.jpg', '<p>Bàn phím cơ chuyên nghiệp cho game thủ esport.</p>', '<p>Switch: GX Blue Clicky<br>Kết nối: USB có thể tháo rời<br>RGB: Lightsync 16.8 triệu màu</p>', 30, 1, 3),
(4, 'Bàn Phím Cơ Razer BlackWidow V3', 2190000, 'Banphim/banphim_2/banphim_2.jpg', '<p>Bàn phím cơ Razer huyền thoại với switch cơ học độc quyền.</p>', '<p>Switch: Razer Green Switch<br>Keycap: ABS Doubleshot<br>Đèn nền: Razer Chroma RGB</p>', 25, 2, 3),
(5, 'Màn Hình Gaming ASUS TUF 24 inch 165Hz', 3690000, 'Manhinh/manhinh_1/manhinh_1.jpg', '<p>Màn hình IPS góc nhìn rộng, tần số quét cao siêu mượt.</p>', '<p>Kích thước: 23.8 inch<br>Độ phân giải: Full HD (1920x1080)<br>Tần số quét: 165Hz<br>Thời gian phản hồi: 1ms</p>', 18, 4, 4),
(6, 'Màn Hình Đồ Họa Dell UltraSharp 27 inch 2K', 9500000, 'Manhinh/manhinh_2/manhinh_2.jpg', '<p>Màn hình đồ họa màu sắc cực kỳ chuẩn xác.</p>', '<p>Kích thước: 27 inch<br>Độ phân giải: 2K QHD (2560x1440)<br>Tấm nền: IPS sRGB 100%</p>', 10, 5, 4),
(7, 'Chuột Không Dây Logitech G Pro X Superlight', 2890000, 'Chuot/chuot_1/chuot_1.jpg', '<p>Chuột gaming không dây siêu nhẹ được tin dùng bởi game thủ hàng đầu.</p>', '<p>Trọng lượng: dưới 63 gram<br>Cảm biến: HERO 25K<br>Kết nối: Lightspeed Wireless</p>', 40, 1, 5),
(8, 'Chuột Gaming Razer DeathAdder V2', 990000, 'Chuot/chuot_2/chuot_2.jpg', '<p>Chuột thiết kế công thái học bán chạy nhất thế giới.</p>', '<p>Cảm biến: Focus+ 20K DPI<br>Switch: Razer Optical Mouse Switch</p>', 50, 2, 5);

-- 5. Thêm dữ liệu giỏ hàng mẫu cho tài khoản 'khachhang'
INSERT INTO `giohang` (`Username`, `ProductID`, `SoLuong`) VALUES
('khachhang', 3, 1),
('khachhang', 7, 2);

-- 6. Thêm Đơn hàng & Chi tiết đơn mẫu
INSERT INTO `donhang` (`OrderID`, `Username`, `HoTen`, `SoDienThoai`, `DiaChi`, `TongTien`, `PhuongThuc`, `TrangThai`, `NgayDat`) VALUES
(1, 'khachhang', 'Nguyễn Văn Khách', '0987654321', 'Số 123 Lê Lợi, Hải Phòng', 16530000, 'COD', 1, '2026-11-10 14:30:00');

INSERT INTO `chitietdonhang` (`OrderID`, `ProductID`, `SoLuong`, `DonGia`, `ThanhTien`) VALUES
(1, 1, 1, 16500000, 16500000);
