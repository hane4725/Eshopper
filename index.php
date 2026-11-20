<?php
/**
 * Điểm điều hướng trung tâm phía Khách hàng (Client Front Controller)
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

// Kiểm tra kết nối CSDL (thông báo thân thiện nếu MySQL chưa bật)
$db = Database::getConnection();
if ($db === null) {
    ?>
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="utf-8">
        <title>EShopper - Thông Báo CSDL</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container py-5">
            <div class="card border-warning shadow-sm mx-auto" style="max-width: 700px;">
                <div class="card-header bg-warning text-dark font-weight-bold h5 mb-0">
                    ⚠️ Chưa phát hiện kết nối Cơ sở dữ liệu MySQL
                </div>
                <div class="card-body">
                    <p class="text-danger font-weight-bold">Chi tiết: <?= htmlspecialchars(Database::getError()) ?></p>
                    <p>Hệ thống mã nguồn PHP MVC đã được chuyển đổi hoàn tất. Để website hoạt động đầy đủ dữ liệu, bạn chỉ cần thực hiện 2 bước đơn giản:</p>
                    <ol>
                        <li>Khởi động dịch vụ <strong>MySQL</strong> (trong XAMPP / Laragon).</li>
                        <li>Mở <strong>phpMyAdmin</strong> và Import file <strong class="text-primary">database_test.sql</strong> (đã có sẵn trong thư mục dự án).</li>
                    </ol>
                    <hr>
                    <p class="mb-0 text-muted small">Cấu hình kết nối nằm tại: <code>config/database.php</code> (Mặc định: Host <code>localhost</code>, User <code>root</code>, Mật khẩu rỗng, Database <code>webbanpc</code>).</p>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}

$controllerName = isset($_GET['controller']) ? ucfirst(trim($_GET['controller'])) : 'TrangChu';
$actionName = isset($_GET['action']) ? trim($_GET['action']) : 'index';

// Danh sách các Controller hợp lệ phía Client
$allowedControllers = [
    'TrangChu',
    'SanPham',
    'ChiTietSanPham',
    'GioHang',
    'ThanhToan',
    'LichSuDonHang',
    'TimKiem',
    'DangNhap',
    'DangKy'
];

if (!in_array($controllerName, $allowedControllers)) {
    $controllerName = 'TrangChu';
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
