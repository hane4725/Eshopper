<?php
require_once __DIR__ . '/../models/SanPhamModel.php';
require_once __DIR__ . '/../models/DanhMucModel.php';
require_once __DIR__ . '/../models/GioHangModel.php';

class TrangChuController {
    public function index() {
        $sanPhamModel = new SanPhamModel();
        
        $spPhoBien = $sanPhamModel->lay8SanPhamTrangChu();
        $spMoiNhat = $sanPhamModel->lay8SanPhamMoiNhat();
        $showBanner = true;
        $pageTitle = "Trang Chủ";

        require_once __DIR__ . '/../views/trang-chu.php';
    }

    public function themGioNhanh() {
        if (!isset($_SESSION['User'])) {
            setFlash('warning', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!');
            redirect(BASE_URL . '/index.php?controller=DangNhap');
        }

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id > 0) {
            $gioHangModel = new GioHangModel();
            $gioHangModel->themVaoGioHang($_SESSION['User'], $id, 1);
            setFlash('success', 'Đã thêm sản phẩm vào giỏ hàng thành công!');
        }
        redirect(BASE_URL . '/index.php?controller=TrangChu');
    }
}
