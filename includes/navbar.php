<?php
require_once __DIR__ . '/../models/DanhMucModel.php';
$danhMucModelNav = new DanhMucModel();
$dsDanhMucNav = $danhMucModelNav->layTatCaDanhMuc();
$currentUser = isset($_SESSION['User']) ? $_SESSION['User'] : null;
$currentRole = isset($_SESSION['Quyen']) ? (string)$_SESSION['Quyen'] : null;
?>
    <!-- Navbar Start (Chuẩn cấu trúc Site.master) -->
    <div class="container-fluid <?= !empty($showBanner) ? 'mb-5' : 'mb-0' ?>">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0 text-white">Danh mục sản Phẩm</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse <?= !empty($showBanner) ? 'show' : '' ?> position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100 overflow-hidden" style="min-height: 250px; max-height: 410px;">
                        <?php if (!empty($dsDanhMucNav)): ?>
                            <?php foreach ($dsDanhMucNav as $dm): ?>
                                <a href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=<?= $dm['CategoryID'] ?>" class="nav-item nav-link">
                                    <?= htmlspecialchars($dm['TenDanhMuc']) ?>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="nav-item nav-link text-muted">Chưa có danh mục</span>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
            
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="<?= BASE_URL ?>/index.php" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="<?= BASE_URL ?>/index.php?controller=TrangChu" class="nav-item nav-link">Trang Chủ</a>
                            <a href="<?= BASE_URL ?>/index.php?controller=GioHang" class="nav-item nav-link">Giỏ Hàng</a>
                            <a href="<?= BASE_URL ?>/index.php?controller=LichSuDonHang" class="nav-item nav-link">Lịch sử giao dịch</a>
                            <?php if ($currentRole === "0" || $currentRole === "2"): ?>
                                <a href="<?= BASE_URL ?>/admin/index.php" class="nav-item nav-link text-danger font-weight-bold">
                                    <i class="fas fa-user-shield mr-1"></i>Vào Quản Trị
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="navbar-nav ml-auto py-0 align-items-center">
                            <?php if ($currentUser): ?>
                                <span class="nav-item text-primary font-weight-bold mr-2"><?= htmlspecialchars($currentUser) ?></span>
                                <a href="<?= BASE_URL ?>/index.php?controller=DangNhap&action=logout" class="nav-item nav-link text-danger" style="margin-left: 20px;">Đăng xuất</a>
                            <?php else: ?>
                                <a href="<?= BASE_URL ?>/index.php?controller=DangNhap" class="nav-item nav-link">Đăng Nhập</a>
                                <a href="<?= BASE_URL ?>/index.php?controller=DangKy" class="nav-item nav-link">Đăng kí</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>

                <?php if (!empty($showBanner)): ?>
                    <!-- Banner Trang Chủ Chuẩn ASP.NET (Banner/BannerTC.jpg, Banner/BannerTC_2.jpg) -->
                    <div id="header-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" style="height: 410px;">
                                <img class="img-fluid" src="<?= BASE_URL ?>/Banner/BannerTC.jpg" alt="Banner Trang Chủ 1" style="object-fit: cover; width:100%; height:100%;">
                            </div>
                            <div class="carousel-item" style="height: 410px;">
                                <img class="img-fluid" src="<?= BASE_URL ?>/Banner/BannerTC_2.jpg" alt="Banner Trang Chủ 2" style="object-fit: cover; width:100%; height:100%;">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-prev-icon mb-n2"></span>
                            </div>
                        </a>
                        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                                <span class="carousel-control-next-icon mb-n2"></span>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <!-- Navbar End -->
