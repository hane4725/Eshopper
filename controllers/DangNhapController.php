<?php
require_once __DIR__ . '/../models/NguoiDungModel.php';

class DangNhapController {
    public function index() {
        if (isset($_SESSION['User'])) {
            redirect(BASE_URL . '/index.php?controller=TrangChu');
        }

        $pageTitle = "Đăng Nhập";
        require_once __DIR__ . '/../views/dang-nhap.php';
    }

    public function xuLyDangNhap() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = trim($_POST['username'] ?? '');
            $pass = trim($_POST['password'] ?? '');

            if (empty($user) || empty($pass)) {
                setFlash('error', 'Vui lòng nhập tên đăng nhập và mật khẩu!');
                redirect(BASE_URL . '/index.php?controller=DangNhap');
            }

            // 1. Kiểm tra tài khoản Admin mặc định nhanh (như trong code C# cũ)
            if ($user === 'Admin' && $pass === '1') {
                $_SESSION['User'] = 'Admin';
                $_SESSION['Quyen'] = 0;
                setFlash('success', 'Đăng nhập quyền Admin thành công!');
                redirect(BASE_URL . '/admin/index.php');
            }

            // 2. Kiểm tra trong Cơ sở dữ liệu với mã hóa MD5 viết hoa
            $passMD5 = strtoupper(md5($pass));
            $nguoiDungModel = new NguoiDungModel();
            $account = $nguoiDungModel->kiemTraDangNhap($user, $passMD5);

            if ($account) {
                $uName = $account['UserName'] ?? $account['Username'] ?? $user;
                $uRole = (int)($account['Quyen'] ?? $account['quyen'] ?? 1);
                $_SESSION['User'] = $uName;
                $_SESSION['Quyen'] = $uRole;

                setFlash('success', 'Đăng nhập thành công! Chào mừng ' . $uName);

                if ($_SESSION['Quyen'] === 0 || $_SESSION['Quyen'] === 2) {
                    redirect(BASE_URL . '/admin/index.php');
                } else {
                    redirect(BASE_URL . '/index.php?controller=TrangChu');
                }
            } else {
                setFlash('error', 'Sai tên đăng nhập hoặc mật khẩu!');
                redirect(BASE_URL . '/index.php?controller=DangNhap');
            }
        }
    }

    public function logout() {
        unset($_SESSION['User']);
        unset($_SESSION['Quyen']);
        setFlash('success', 'Đã đăng xuất tài khoản thành công!');
        redirect(BASE_URL . '/index.php?controller=DangNhap');
    }
}
