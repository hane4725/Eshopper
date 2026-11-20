<?php
require_once __DIR__ . '/../models/DonHangModel.php';

class LichSuDonHangController {
    public function index() {
        if (!isset($_SESSION['User'])) {
            setFlash('warning', 'Vui lòng đăng nhập để xem lịch sử đơn hàng!');
            redirect(BASE_URL . '/index.php?controller=DangNhap');
        }

        $username = $_SESSION['User'];
        $donHangModel = new DonHangModel();
        $dsDonHang = $donHangModel->layLichSuDonHang($username);

        $pageTitle = "Lịch Sử Giao Dịch";
        require_once __DIR__ . '/../views/lich-su-don-hang.php';
    }

    public function chiTiet() {
        if (!isset($_SESSION['User'])) redirect(BASE_URL . '/index.php?controller=DangNhap');

        $orderId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $donHangModel = new DonHangModel();
        $donHang = $donHangModel->layDonHangTheoId($orderId);

        if (!$donHang || ($donHang['UserName'] ?? $donHang['Username'] ?? '') !== $_SESSION['User']) {
            setFlash('error', 'Không tìm thấy đơn hàng!');
            redirect(BASE_URL . '/index.php?controller=LichSuDonHang');
        }

        $chiTiet = $donHangModel->layChiTietDonHang($orderId);
        $pageTitle = "Chi Tiết Đơn Hàng #" . $orderId;
        require_once __DIR__ . '/../views/chi-tiet-don-hang-khach.php';
    }
}
