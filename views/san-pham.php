<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../includes/navbar.php'; ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3"><?= htmlspecialchars($danhMucHienTai['TenDanhMuc'] ?? 'Sản Phẩm') ?></h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="<?= BASE_URL ?>/index.php">Trang Chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0"><?= htmlspecialchars($danhMucHienTai['TenDanhMuc'] ?? 'Danh Mục') ?></p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <form action="<?= BASE_URL ?>/index.php" method="GET">
                <input type="hidden" name="controller" value="SanPham">
                <input type="hidden" name="nId" value="<?= $nId ?>">

                <!-- Price Filter -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Khoảng Giá</h5>
                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" class="custom-control-input" id="price-all" name="gia" value="all" <?= ($priceRange === 'all' || empty($priceRange)) ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="price-all">Tất cả mức giá</label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" class="custom-control-input" id="price-1" name="gia" value="0-2000000" <?= ($priceRange === '0-2000000') ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="price-1">Dưới 2 triệu</label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" class="custom-control-input" id="price-2" name="gia" value="2000000-5000000" <?= ($priceRange === '2000000-5000000') ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="price-2">2 triệu - 5 triệu</label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" class="custom-control-input" id="price-3" name="gia" value="5000000-10000000" <?= ($priceRange === '5000000-10000000') ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="price-3">5 triệu - 10 triệu</label>
                    </div>
                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" class="custom-control-input" id="price-4" name="gia" value="10000000-max" <?= ($priceRange === '10000000-max') ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="price-4">Trên 10 triệu</label>
                    </div>
                </div>

                <!-- Brand Filter (Ẩn nếu là PC theo logic cũ) -->
                <?php if ($nId != 1 && $nId != 2): ?>
                    <div class="border-bottom mb-4 pb-4">
                        <h5 class="font-weight-semi-bold mb-4">Hãng Sản Xuất</h5>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" class="custom-control-input" id="brand-all" name="hang" value="0" <?= ($brandId == 0) ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="brand-all">Tất cả hãng</label>
                        </div>
                        <?php foreach ($dsHang as $h): ?>
                            <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                                <input type="radio" class="custom-control-input" id="brand-<?= $h['BrandID'] ?>" name="hang" value="<?= $h['BrandID'] ?>" <?= ($brandId == $h['BrandID']) ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="brand-<?= $h['BrandID'] ?>"><?= htmlspecialchars($h['TenHang']) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-4 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary px-4"><i class="fa fa-filter mr-1"></i>Lọc</button>
                    <a href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=<?= $nId ?>" class="btn btn-outline-secondary px-3">Xóa lọc</a>
                </div>
            </form>
        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <?php if (!empty($dsSanPham)): ?>
                    <?php foreach ($dsSanPham as $sp): ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4 shadow-sm">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0" style="height: 230px;">
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
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Giỏ
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <i class="fa fa-box-open fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Không tìm thấy sản phẩm nào phù hợp với bộ lọc!</h5>
                    </div>
                <?php endif; ?>

                <!-- Pagination -->
                <?php if ($tongSoTrang > 1): ?>
                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=<?= $nId ?>&gia=<?= $priceRange ?>&hang=<?= $brandId ?>&page=<?= $currentPage - 1 ?>">Trước</a>
                                </li>
                                <?php for ($i = 1; $i <= $tongSoTrang; $i++): ?>
                                    <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                        <a class="page-link" href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=<?= $nId ?>&gia=<?= $priceRange ?>&hang=<?= $brandId ?>&page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?= ($currentPage >= $tongSoTrang) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=<?= $nId ?>&gia=<?= $priceRange ?>&hang=<?= $brandId ?>&page=<?= $currentPage + 1 ?>">Sau</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
