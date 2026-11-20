<?php
/**
 * Điểm điều hướng trung tâm phía Quản trị (Admin Front Controller)
 */
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

// Kiểm tra quyền truy cập Admin / Nhân viên
if (!isset($_SESSION['User']) || !isset($_SESSION['Quyen']) || ($_SESSION['Quyen'] != 0 && $_SESSION['Quyen'] != 2)) {
    setFlash('warning', 'Vui lòng đăng nhập với tư cách Quản trị viên để truy cập trang này!');
    redirect(BASE_URL . '/index.php?controller=DangNhap');
}

$controllerName = isset($_GET['controller']) ? ucfirst(trim($_GET['controller'])) : 'BangDieuKhien';
$actionName = isset($_GET['action']) ? trim($_GET['action']) : 'index';

// Danh sách các Controller hợp lệ trong Admin
$allowedControllers = [
    'BangDieuKhien',
    'QuanLySanPham',
    'QuanLyDanhMuc',
    'QuanLyHang',
    'QuanLyDonHang',
    'QuanLyNguoiDung'
];

if (!in_array($controllerName, $allowedControllers)) {
    $controllerName = 'BangDieuKhien';
}

$controllerFile = __DIR__ . '/controllers/' . $controllerName . 'Controller.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = $controllerName . 'Controller';
    if (class_exists($className)) {
        $controllerInstance = new $className();
        if (method_exists($controllerInstance, $actionName)) {
            $controllerInstance->$actionName();
        } else {
            $controllerInstance->index();
        }
    } else {
        die("Không tìm thấy class controller: " . htmlspecialchars($className));
    }
} else {
    die("Không tìm thấy file controller: " . htmlspecialchars($controllerFile));
}
