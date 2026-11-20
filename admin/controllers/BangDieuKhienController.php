<?php
require_once __DIR__ . '/../../models/SanPhamModel.php';
require_once __DIR__ . '/../../models/DonHangModel.php';
require_once __DIR__ . '/../../models/NguoiDungModel.php';
require_once __DIR__ . '/../../models/DanhMucModel.php';

class BangDieuKhienController {
    public function index() {
        $spModel = new SanPhamModel();
        $dhModel = new DonHangModel();
        $userModel = new NguoiDungModel();
        $dmModel = new DanhMucModel();

        $tongSP = count($spModel->layTatCaSanPham());
        $tongDH = count($dhModel->layTatCaDonHang());
        $tongUser = count($userModel->layTatCaNguoiDung());
        $tongDM = count($dmModel->layTatCaDanhMuc());

        $donHangMoi = array_slice($dhModel->layTatCaDonHang(), 0, 5);

        $pageTitle = "Bảng Điều Khiển";
        require_once __DIR__ . '/../views/tong-quan.php';
    }
}
