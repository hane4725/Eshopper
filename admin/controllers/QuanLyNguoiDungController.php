<?php
require_once __DIR__ . '/../../models/NguoiDungModel.php';

class QuanLyNguoiDungController {
    public function index() {
        $userModel = new NguoiDungModel();
        $dsNguoiDung = $userModel->layTatCaNguoiDung();
        $pageTitle = "Quản Lý Người Dùng";
        require_once __DIR__ . '/../views/danh-sach-nguoi-dung.php';
    }

    public function capNhatQuyen() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $quyenMoi = isset($_POST['quyen']) ? (int)$_POST['quyen'] : 1;

            if ($username === $_SESSION['User'] && $quyenMoi != 0) {
                setFlash('error', 'Không thể tự hạ quyền Admin của chính mình!');
                redirect(BASE_URL . '/admin/index.php?controller=QuanLyNguoiDung');
            }

            $userModel = new NguoiDungModel();
            $userModel->capNhatQuyen($username, $quyenMoi);
            setFlash('success', 'Cập nhật phân quyền cho tài khoản ' . $username . ' thành công!');
        }
        redirect(BASE_URL . '/admin/index.php?controller=QuanLyNguoiDung');
    }

    public function xoa() {
        $username = trim($_GET['user'] ?? '');
        if ($username === $_SESSION['User']) {
            setFlash('error', 'Không thể tự xóa tài khoản của chính mình!');
            redirect(BASE_URL . '/admin/index.php?controller=QuanLyNguoiDung');
        }

        $userModel = new NguoiDungModel();
        $userModel->xoaNguoiDung($username);
        setFlash('success', 'Đã xóa tài khoản ' . $username . ' thành công!');
        redirect(BASE_URL . '/admin/index.php?controller=QuanLyNguoiDung');
    }
}
