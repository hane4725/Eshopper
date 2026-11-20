<?php
require_once __DIR__ . '/../models/NguoiDungModel.php';

class DangKyController {
    public function index() {
        if (isset($_SESSION['User'])) {
            redirect(BASE_URL . '/index.php?controller=TrangChu');
        }

        $pageTitle = "Đăng Ký Tài Khoản";
        require_once __DIR__ . '/../views/dang-ky.php';
    }

    public function xuLyDangKy() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $rePassword = trim($_POST['rePassword'] ?? '');
            $hoTen = trim($_POST['hoTen'] ?? '');
            $sdt = trim($_POST['soDienThoai'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $diaChi = trim($_POST['diaChi'] ?? '');

            if (empty($username) || empty($password) || empty($hoTen) || empty($sdt)) {
                setFlash('error', 'Vui lòng điền đầy đủ các thông tin bắt buộc (*)!');
                redirect(BASE_URL . '/index.php?controller=DangKy');
            }

            if ($password !== $rePassword) {
                setFlash('error', 'Mật khẩu xác nhận không khớp!');
                redirect(BASE_URL . '/index.php?controller=DangKy');
            }

            $passMD5 = strtoupper(md5($password));
            $nguoiDungModel = new NguoiDungModel();

            try {
                $nguoiDungModel->dangKyTaiKhoan($username, $passMD5, $hoTen, $sdt, $email, $diaChi);
                setFlash('success', 'Đăng ký tài khoản thành công! Vui lòng đăng nhập.');
                redirect(BASE_URL . '/index.php?controller=DangNhap');
            } catch (Exception $e) {
                setFlash('error', $e->getMessage());
                redirect(BASE_URL . '/index.php?controller=DangKy');
            }
        }
    }
}
