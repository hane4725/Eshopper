<?php
require_once __DIR__ . '/../../models/HangSanXuatModel.php';

class QuanLyHangController {
    public function index() {
        $hangModel = new HangSanXuatModel();
        $dsHang = $hangModel->layTatCaHang();
        $pageTitle = "Quản Lý Hãng Sản Xuất";
        require_once __DIR__ . '/../views/danh-sach-hang.php';
    }

    public function them() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenHang = trim($_POST['tenHang'] ?? '');
            if (empty($tenHang)) {
                setFlash('error', 'Tên hãng không được để trống!');
                redirect(BASE_URL . '/admin/index.php?controller=QuanLyHang&action=them');
            }

            $hangModel = new HangSanXuatModel();
            $hangModel->themHang($tenHang);
            setFlash('success', 'Thêm hãng sản xuất thành công!');
            redirect(BASE_URL . '/admin/index.php?controller=QuanLyHang');
        }

        $pageTitle = "Thêm Hãng Sản Xuất";
        require_once __DIR__ . '/../views/them-hang.php';
    }

    public function sua() {
        $id = isset($_GET['nId']) ? (int)$_GET['nId'] : 0;
        $hangModel = new HangSanXuatModel();
        $hang = $hangModel->layChiTietHang($id);

        if (!$hang) {
            setFlash('error', 'Không tìm thấy hãng!');
            redirect(BASE_URL . '/admin/index.php?controller=QuanLyHang');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenHang = trim($_POST['tenHang'] ?? '');
            if (empty($tenHang)) {
                setFlash('error', 'Tên hãng không được để trống!');
                redirect(BASE_URL . '/admin/index.php?controller=QuanLyHang&action=sua&nId=' . $id);
            }

            $hangModel->suaHang($id, $tenHang);
            setFlash('success', 'Cập nhật hãng thành công!');
            redirect(BASE_URL . '/admin/index.php?controller=QuanLyHang');
        }

        $pageTitle = "Sửa Hãng Sản Xuất #" . $id;
        require_once __DIR__ . '/../views/sua-hang.php';
    }

    public function xoa() {
        $id = isset($_GET['nId']) ? (int)$_GET['nId'] : 0;
        $hangModel = new HangSanXuatModel();
        $hangModel->xoaHang($id);
        setFlash('success', 'Đã xóa hãng sản xuất!');
        redirect(BASE_URL . '/admin/index.php?controller=QuanLyHang');
    }
}
