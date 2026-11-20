<?php
require_once __DIR__ . '/../models/SanPhamModel.php';

class TimKiemController {
    public function index() {
        $tuKhoa = trim($_GET['q'] ?? '');

        $sanPhamModel = new SanPhamModel();
        $limit = 12;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($currentPage < 1) $currentPage = 1;
        $offset = ($currentPage - 1) * $limit;

        $dsSanPham = [];
        $tongSoSanPham = 0;
        $tongSoTrang = 0;

        if (!empty($tuKhoa)) {
            $dsSanPham = $sanPhamModel->timKiemToanSite($tuKhoa, $limit, $offset);
            $tongSoSanPham = $sanPhamModel->demTimKiemToanSite($tuKhoa);
            $tongSoTrang = ceil($tongSoSanPham / $limit);
        }

        $pageTitle = "Tìm Kiếm: " . htmlspecialchars($tuKhoa);
        require_once __DIR__ . '/../views/tim-kiem.php';
    }
}
