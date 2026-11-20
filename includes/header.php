<?php
require_once __DIR__ . '/../config/config.php';
$currentUser = isset($_SESSION['User']) ? $_SESSION['User'] : null;
$currentRole = isset($_SESSION['Quyen']) ? (string)$_SESSION['Quyen'] : null;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - EShopper' : 'EShopper - Cửa Hàng Máy Tính & Linh Kiện' ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?= BASE_URL ?>/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= BASE_URL ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= BASE_URL ?>/css/style.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <span class="text-dark">Liên hệ để nhận hỗ trợ qua</span>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                    <a class="text-dark px-2" href="https://x.com/"><i class="fab fa-twitter"></i></a>
                    <a class="text-dark px-2" href="https://www.tncstore.vn/"><i class="fab fa-linkedin-in"></i></a>
                    <a class="text-dark px-2" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                    <a class="text-dark pl-2" href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="<?= BASE_URL ?>/index.php" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="<?= BASE_URL ?>/index.php" method="GET">
                    <input type="hidden" name="controller" value="TimKiem">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Tìm kiếm sản phẩm..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" required>
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="<?= BASE_URL ?>/index.php?controller=GioHang" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge badge-primary text-white ml-1">Giỏ Hàng</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
