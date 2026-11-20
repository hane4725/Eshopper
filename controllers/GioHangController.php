<?php
require_once __DIR__ . '/../models/GioHangModel.php';
require_once __DIR__ . '/../models/SanPhamModel.php';

class GioHangController {
    public function index() {
        if (!isset($_SESSION['User'])) {
            setFlash('warning', 'Vui lòng đăng nhập để xem giỏ hàng!');
            redirect(BASE_URL . '/index.php?controller=DangNhap');
        }

        $username = $_SESSION['User'];
        $gioHangModel = new GioHangModel();
        $dsGioHang = $gioHangModel->layGioHang($username);

        $tongTien = 0;
        foreach ($dsGioHang as $item) {
            $tongTien += (float)$item['ThanhTien'];
        }

        $pageTitle = "Giỏ Hàng Của Bạn";
        require_once __DIR__ . '/../views/gio-hang.php';
    }

    public function tang() {
        if (!isset($_SESSION['User'])) redirect(BASE_URL . '/index.php?controller=DangNhap');
        $pid = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $currentQty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;

        $sanPhamModel = new SanPhamModel();
        $sp = $sanPhamModel->layChiTietSanPham($pid);

        if ($sp && ($currentQty + 1) > $sp['SoLuongTon']) {
            setFlash('warning', 'Xin lỗi, kho chỉ còn ' . $sp['SoLuongTon'] . ' sản phẩm!');
        } else {
            $gioHangModel = new GioHangModel();
            $gioHangModel->capNhatSoLuong($_SESSION['User'], $pid, $currentQty + 1);
        }
        redirect(BASE_URL . '/index.php?controller=GioHang');
    }

    public function giam() {
        if (!isset($_SESSION['User'])) redirect(BASE_URL . '/index.php?controller=DangNhap');
        $pid = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $currentQty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;

        $gioHangModel = new GioHangModel();
        if ($currentQty - 1 > 0) {
            $gioHangModel->capNhatSoLuong($_SESSION['User'], $pid, $currentQty - 1);
        } else {
            $gioHangModel->xoaKhoiGioHang($_SESSION['User'], $pid);
            setFlash('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
        }
        redirect(BASE_URL . '/index.php?controller=GioHang');
    }

    public function xoa() {
        if (!isset($_SESSION['User'])) redirect(BASE_URL . '/index.php?controller=DangNhap');
        $pid = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $gioHangModel = new GioHangModel();
        $gioHangModel->xoaKhoiGioHang($_SESSION['User'], $pid);
        setFlash('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
        redirect(BASE_URL . '/index.php?controller=GioHang');
    }
}
