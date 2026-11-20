<?php
require_once __DIR__ . '/../models/DonHangModel.php';
require_once __DIR__ . '/../models/GioHangModel.php';
require_once __DIR__ . '/../models/NguoiDungModel.php';

class ThanhToanController {
    public function index() {
        if (!isset($_SESSION['User'])) {
            setFlash('warning', 'Vui lòng đăng nhập để thanh toán!');
            redirect(BASE_URL . '/index.php?controller=DangNhap');
        }

        $username = $_SESSION['User'];
        $gioHangModel = new GioHangModel();
        $dsGioHang = $gioHangModel->layGioHang($username);

        if (empty($dsGioHang)) {
            setFlash('warning', 'Giỏ hàng của bạn đang trống!');
            redirect(BASE_URL . '/index.php?controller=TrangChu');
        }

        // Lấy thông tin user hiện tại
        $nguoiDungModel = new NguoiDungModel();
        $userInfo = $nguoiDungModel->layThongTinUser($username);

        $tongTienHang = 0;
        foreach ($dsGioHang as $item) {
            $tongTienHang += (float)$item['ThanhTien'];
        }
        $phiShip = 30000;
        $tongThanhToan = $tongTienHang + $phiShip;

        $pageTitle = "Thanh Toán Đơn Hàng";
        require_once __DIR__ . '/../views/thanh-toan.php';
    }

    public function datHang() {
        if (!isset($_SESSION['User'])) redirect(BASE_URL . '/index.php?controller=DangNhap');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_SESSION['User'];
            $hoTen = trim($_POST['hoTen'] ?? '');
            $sdt = trim($_POST['soDienThoai'] ?? '');
            $diaChi = trim($_POST['diaChi'] ?? '');
            $phuongThuc = trim($_POST['phuongThuc'] ?? 'COD');

            if (empty($hoTen) || empty($sdt) || empty($diaChi)) {
                setFlash('error', 'Vui lòng điền đầy đủ họ tên, số điện thoại và địa chỉ nhận hàng!');
                redirect(BASE_URL . '/index.php?controller=ThanhToan');
            }

            // Tính lại tổng tiền từ giỏ hàng thực tế trong DB
            $gioHangModel = new GioHangModel();
            $dsGioHang = $gioHangModel->layGioHang($username);

            if (empty($dsGioHang)) {
                setFlash('warning', 'Giỏ hàng của bạn đang trống!');
                redirect(BASE_URL . '/index.php?controller=TrangChu');
            }

            $tongTienHang = 0;
            foreach ($dsGioHang as $item) {
                $tongTienHang += (float)$item['ThanhTien'];
            }
            $tongThanhToan = $tongTienHang + 30000;

            try {
                $donHangModel = new DonHangModel();
                $orderId = $donHangModel->thanhToanDonHang($username, $hoTen, $sdt, $diaChi, $tongThanhToan, $phuongThuc);

                setFlash('success', 'Đặt hàng thành công! Mã đơn của bạn là #' . $orderId);
                redirect(BASE_URL . '/index.php?controller=LichSuDonHang');
            } catch (Exception $e) {
                setFlash('error', 'Lỗi thanh toán: ' . $e->getMessage());
                redirect(BASE_URL . '/index.php?controller=ThanhToan');
            }
        }
    }
}
