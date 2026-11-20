<?php
require_once __DIR__ . '/../../config/config.php';

// Kiểm tra quyền Admin/Nhân viên
if (!isset($_SESSION['User']) || !isset($_SESSION['Quyen']) || ($_SESSION['Quyen'] != 0 && $_SESSION['Quyen'] != 2)) {
    setFlash('error', 'Bạn không có quyền truy cập trang quản trị!');
    redirect(BASE_URL . '/index.php?controller=DangNhap');
}

$adminUser = $_SESSION['User'];
$adminRole = (int)$_SESSION['Quyen']; // 0: Admin, 2: Nhan vien
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - Quản Trị Hệ Thống' : 'Quản Trị Hệ Thống - EShopper' ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Bootstrap & FontAwesome -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CKEditor 4 CDN cho phần mô tả bài viết -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Roboto, sans-serif; background: linear-gradient(to right, #e8f0ff, #fdfbff); color: #333; line-height: 1.6; }
        .container-admin { width: 95%; margin: 0 auto; }
        header { background: rgba(255, 255, 255, 0.95); box-shadow: 0 2px 10px rgba(0,0,0,0.1); backdrop-filter: blur(10px); position: sticky; top: 0; z-index: 1000; }
        .header-container { display: flex; align-items: center; justify-content: space-between; padding: 10px 0; }
        .logo { font-size: 32px; font-weight: 700; color: #0078ff; letter-spacing: 1px; flex: 0 0 auto; margin-right: 20px; text-decoration: none; }
        .nav-center { flex: 1; display: flex; justify-content: center; }
        .nav-center ul { list-style: none; display: flex; gap: 10px; padding: 0; margin: 0; flex-wrap: wrap; justify-content: center; }
        .nav-center ul li a { text-decoration: none; color: #444; font-weight: 600; font-size: 14px; padding: 8px 12px; border-radius: 6px; transition: all 0.3s ease; white-space: nowrap; }
        .nav-center ul li a:hover, .nav-center ul li a.active { color: #0078ff; background-color: #f0f7ff; text-shadow: 0 0 1px rgba(0,120,255,0.4); }
        .hero { background: linear-gradient(135deg, #0078ff, #00c3ff); color: white; text-align: center; padding: 16px 20px; border-radius: 0 0 40px 40px; box-shadow: 0 8px 16px rgba(0,0,0,0.15); margin-bottom: 25px; }
        .hero h2 { font-size: 28px; margin: 0; }
        .main-content-card { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 40px; }
        footer.admin-footer { background: linear-gradient(135deg, #0078ff, #00c3ff); color: white; text-align: center; padding: 15px 20px; border-radius: 20px 20px 0 0; margin-top: auto; }
    </style>
</head>
<body>
    <header>
        <div class="container-admin header-container">
            <a href="<?= BASE_URL ?>/admin/index.php" class="logo">✨ Eshopper Admin</a>
            <nav class="nav-center">
                <ul>
                    <?php if ($adminRole === 0): ?>
                        <li><a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDonHang"><i class="fas fa-file-invoice mr-1"></i>Đơn Hàng</a></li>
                        <li><a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyNguoiDung"><i class="fas fa-users mr-1"></i>Người Dùng</a></li>
                        <li><a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLySanPham"><i class="fas fa-boxes mr-1"></i>Hàng Hóa</a></li>
                        <li><a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDanhMuc"><i class="fas fa-tags mr-1"></i>Danh Mục</a></li>
                        <li><a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyHang"><i class="fas fa-copyright mr-1"></i>Hãng SX</a></li>
                    <?php endif; ?>

                    <li><a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLySanPham&action=them"><i class="fas fa-plus-circle mr-1"></i>Thêm Hàng</a></li>
                    <li><a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDanhMuc&action=them"><i class="fas fa-folder-plus mr-1"></i>Thêm Danh Mục</a></li>
                    <li><a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyHang&action=them"><i class="fas fa-plus-square mr-1"></i>Thêm Hãng</a></li>
                </ul>
            </nav>
            <div class="nav-right">
                <a href="<?= BASE_URL ?>/index.php" class="btn btn-outline-primary btn-sm mr-2" target="_blank"><i class="fas fa-external-link-alt mr-1"></i>Xem Website</a>
                <span class="font-weight-bold text-dark">Hi: <span class="text-primary"><?= htmlspecialchars($adminUser) ?></span></span>
                <span class="mx-2 text-muted">|</span>
                <a href="<?= BASE_URL ?>/index.php?controller=DangNhap&action=logout" class="text-danger font-weight-bold" style="text-decoration:none;">Đăng xuất</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <h2>Xin chào <span class="text-warning font-weight-bold"><?= htmlspecialchars($adminUser) ?></span> đến với hệ thống Quản Trị ✨ Eshopper</h2>
    </section>

    <main class="container-admin">
        <div class="main-content-card">
