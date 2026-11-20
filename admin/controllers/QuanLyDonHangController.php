<?php
require_once __DIR__ . '/../../models/DonHangModel.php';

class QuanLyDonHangController {
    public function index() {
        $dhModel = new DonHangModel();
        $dsDonHang = $dhModel->layTatCaDonHang();
        $pageTitle = "Quản Lý Đơn Hàng";
        require_once __DIR__ . '/../views/danh-sach-don-hang.php';
    }

    public function capNhat() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = isset($_POST['orderId']) ? (int)$_POST['orderId'] : 0;
            $trangThaiMoi = isset($_POST['trangThai']) ? (int)$_POST['trangThai'] : 0;

            $dhModel = new DonHangModel();
            $dhModel->capNhatTrangThai($orderId, $trangThaiMoi);
            setFlash('success', 'Cập nhật trạng thái đơn hàng #' . $orderId . ' thành công!');
        }
        redirect(BASE_URL . '/admin/index.php?controller=QuanLyDonHang');
    }

    public function chiTiet() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $dhModel = new DonHangModel();
        $donHang = $dhModel->layDonHangTheoId($id);

        if (!$donHang) {
            setFlash('error', 'Không tìm thấy đơn hàng!');
            redirect(BASE_URL . '/admin/index.php?controller=QuanLyDonHang');
        }

        $chiTiet = $dhModel->layChiTietDonHang($id);
        $pageTitle = "Chi Tiết Đơn Hàng #" . $id;
        require_once __DIR__ . '/../views/chi-tiet-don-hang.php';
    }
}
