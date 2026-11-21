<?php
require_once __DIR__ . '/../models/SanPhamModel.php';
require_once __DIR__ . '/../models/DanhMucModel.php';
require_once __DIR__ . '/../models/HangSanXuatModel.php';

class SanPhamController {
    public function index() {
        $nId = isset($_GET['nId']) ? (int)$_GET['nId'] : 0;
        if ($nId <= 0) {
            redirect(BASE_URL . '/index.php?controller=TrangChu');
        }

        $sanPhamModel = new SanPhamModel();
        $danhMucModel = new DanhMucModel();
        $hangModel = new HangSanXuatModel();

        // Lấy thông tin danh mục hiện tại
        $danhMucHienTai = $danhMucModel->layChiTietDanhMuc($nId);
        $dsHang = $hangModel->layTatCaHang();

        // Xử lý bộ lọc
        $priceRange = isset($_GET['gia']) ? $_GET['gia'] : 'all';
        $brandId = isset($_GET['hang']) ? (int)$_GET['hang'] : 0;

        $minPrice = 0;
        $maxPrice = 999999999;

        if ($priceRange !== 'all' && strpos($priceRange, '-') !== false) {
            $parts = explode('-', $priceRange);
            $minPrice = (int)$parts[0];
            $maxPrice = ($parts[1] === 'max') ? 999999999 : (int)$parts[1];
        }

        // Xử lý phân trang
        $limit = 12;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($currentPage < 1) $currentPage = 1;
        $offset = ($currentPage - 1) * $limit;

        // Truy vấn dữ liệu theo bộ lọc
        $dsSanPham = $sanPhamModel->locSanPham($nId, $minPrice, $maxPrice, $brandId, $limit, $offset);
        $tongSoSanPham = $sanPhamModel->demLocSanPham($nId, $minPrice, $maxPrice, $brandId);
        $tongSoTrang = ceil($tongSoSanPham / $limit);

        $pageTitle = $danhMucHienTai ? $danhMucHienTai['TenDanhMuc'] : "Danh Sách Sản Phẩm";

        require_once __DIR__ . '/../views/san-pham.php';
    }
}
