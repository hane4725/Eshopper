<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php 
$showBanner = true; 
require_once __DIR__ . '/../includes/navbar.php'; 
?>

<!-- Featured Start (Chuẩn 4 tiện ích nguyên bản ASP.NET) -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Linh Kiện Chính Hãng</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Giao Hàng Toàn Quốc</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14 Ngày Đổi Trả</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Hỗ Trợ 24/7</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->

<!-- 3 Promotional Banners (Chuẩn nguyên bản ASP.NET Trangchu.aspx) -->
<div class="container-fluid pt-2 pb-3">
    <div class="row px-xl-5">
        <!-- Banner 1: Bàn Phím Cơ (Giảm tới 40%) -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="overflow-hidden shadow-sm" style="border-radius: 4px; transition: transform 0.3s ease;">
                <a href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=3">
                    <img class="img-fluid w-100" src="<?= BASE_URL ?>/Banner/BP.jpg" alt="Bàn Phím Cơ - Giảm tới 40%">
                </a>
            </div>
        </div>

        <!-- Banner 2: Màn Hình Gaming (Giảm tới 25%) -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="overflow-hidden shadow-sm" style="border-radius: 4px; transition: transform 0.3s ease;">
                <a href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=4">
                    <img class="img-fluid w-100" src="<?= BASE_URL ?>/Banner/MH.jpg" alt="Màn Hình Gaming - Giảm tới 25%">
                </a>
            </div>
        </div>

        <!-- Banner 3: PC Gaming (Tặng ngay 19TR) -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="overflow-hidden shadow-sm" style="border-radius: 4px; transition: transform 0.3s ease;">
                <a href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=2">
                    <img class="img-fluid w-100" src="<?= BASE_URL ?>/Banner/PC_G.jpg" alt="PC Gaming - Tặng ngay 19TR">
                </a>
            </div>
        </div>
    </div>
</div>
<!-- 3 Promotional Banners End -->

<!-- Products Start (Sản Phẩm Phổ Biến) -->
<div class="container-fluid pt-4">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">— Sản Phẩm Phổ Biến —</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <?php if (!empty($spPhoBien)): ?>
            <?php foreach ($spPhoBien as $sp): ?>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4 shadow-sm">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0" style="height: 250px;">
                            <img class="img-fluid w-100 h-100" style="object-fit: contain;" src="<?= BASE_URL . '/' . htmlspecialchars($sp['HinhAnh']) ?>" alt="<?= htmlspecialchars($sp['TenSanPham']) ?>">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3 px-2 font-weight-bold" title="<?= htmlspecialchars($sp['TenSanPham']) ?>"><?= htmlspecialchars($sp['TenSanPham']) ?></h6>
                            <div class="d-flex justify-content-center">
                                <h6 class="text-danger font-weight-bold"><?= number_format($sp['Gia'], 0, ',', '.') ?> đ</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="<?= BASE_URL ?>/index.php?controller=ChiTietSanPham&nId=<?= $sp['ProductID'] ?>" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-eye text-primary mr-1"></i>Xem Chi Tiết
                            </a>
                            <a href="<?= BASE_URL ?>/index.php?controller=TrangChu&action=themGioNhanh&id=<?= $sp['ProductID'] ?>" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Giỏ Hàng
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-4">
                <p class="text-muted">Đang cập nhật sản phẩm nổi bật...</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- Products End -->

<!-- Products Start (Mới cập nhật) -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">— Hàng Mới Về —</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <?php if (!empty($spMoiNhat)): ?>
            <?php foreach ($spMoiNhat as $sp): ?>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4 shadow-sm">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0" style="height: 250px;">
                            <img class="img-fluid w-100 h-100" style="object-fit: contain;" src="<?= BASE_URL . '/' . htmlspecialchars($sp['HinhAnh']) ?>" alt="<?= htmlspecialchars($sp['TenSanPham']) ?>">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3 px-2 font-weight-bold" title="<?= htmlspecialchars($sp['TenSanPham']) ?>"><?= htmlspecialchars($sp['TenSanPham']) ?></h6>
                            <div class="d-flex justify-content-center">
                                <h6 class="text-danger font-weight-bold"><?= number_format($sp['Gia'], 0, ',', '.') ?> đ</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="<?= BASE_URL ?>/index.php?controller=ChiTietSanPham&nId=<?= $sp['ProductID'] ?>" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-eye text-primary mr-1"></i>Xem Chi Tiết
                            </a>
                            <a href="<?= BASE_URL ?>/index.php?controller=TrangChu&action=themGioNhanh&id=<?= $sp['ProductID'] ?>" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Giỏ Hàng
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-4">
                <p class="text-muted">Đang cập nhật sản phẩm mới...</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- Products End -->

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
