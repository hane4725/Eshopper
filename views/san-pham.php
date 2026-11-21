<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../includes/navbar.php'; ?>

<!-- Category Header & Banner (Chuẩn nguyên bản ASP.NET TrangSanPham.aspx) -->
<div class="container-fluid px-xl-5 pt-3">
    <!-- Breadcrumb: Trang chủ > Tên Danh Mục -->
    <div class="mb-2">
        <small class="text-muted font-weight-medium">
            <a href="<?= BASE_URL ?>/index.php" class="text-secondary">Trang chủ</a> 
            <i class="fa fa-angle-right mx-1 text-muted"></i> 
            <span class="text-secondary"><?= htmlspecialchars($danhMucHienTai['TenDanhMuc'] ?? 'Sản Phẩm') ?></span>
        </small>
    </div>

    <!-- Category Banner: Hiển thị đúng ảnh quảng cáo danh mục (AnhDM) -->
    <?php if (!empty($danhMucHienTai['AnhDM'])): ?>
        <div class="mb-4 shadow-sm" style="border-radius: 4px; overflow: hidden;">
            <img class="img-fluid w-100" src="<?= BASE_URL . '/' . htmlspecialchars($danhMucHienTai['AnhDM']) ?>" alt="<?= htmlspecialchars($danhMucHienTai['TenDanhMuc']) ?>" style="display: block; width: 100%;">
        </div>
    <?php endif; ?>
</div>

<!-- Shop Start -->
<div class="container-fluid px-xl-5">
    <div class="row">
        <!-- Shop Sidebar Start (Bộ Lọc Chuẩn ASP.NET) -->
        <div class="col-lg-3 col-md-12">
            <form action="<?= BASE_URL ?>/index.php" method="GET">
                <input type="hidden" name="controller" value="SanPham">
                <input type="hidden" name="nId" value="<?= $nId ?>">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="font-weight-bold m-0 text-dark">Bộ Lọc</h5>
                    <button type="submit" class="btn btn-sm btn-primary px-3 font-weight-bold shadow-sm">Áp Dụng</button>
                </div>

                <!-- Price Filter -->
                <div class="border-bottom mb-4 pb-4">
                    <h6 class="font-weight-bold mb-3 text-dark">Khoảng Giá</h6>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" class="custom-control-input" id="price-all" name="gia" value="all" <?= ($priceRange === 'all' || empty($priceRange)) ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="price-all">Tất cả mức giá</label>
                    </div>
                    <?php if ($nId == 1 || $nId == 2): ?>
                        <!-- Mức giá cho Máy Tính / PC -->
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" class="custom-control-input" id="price-1" name="gia" value="10000000-20000000" <?= ($priceRange === '10000000-20000000') ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="price-1">10 triệu – 20 triệu</label>
                        </div>
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" class="custom-control-input" id="price-2" name="gia" value="20000000-30000000" <?= ($priceRange === '20000000-30000000') ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="price-2">20 triệu – 30 triệu</label>
                        </div>
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" class="custom-control-input" id="price-3" name="gia" value="30000000-40000000" <?= ($priceRange === '30000000-40000000') ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="price-3">30 triệu – 40 triệu</label>
                        </div>
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" class="custom-control-input" id="price-4" name="gia" value="40000000-max" <?= ($priceRange === '40000000-max') ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="price-4">Trên 40 triệu</label>
                        </div>
                    <?php else: ?>
                        <!-- Mức giá cho Linh kiện / Phụ kiện (Bàn phím, Chuột, Màn hình) -->
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" class="custom-control-input" id="price-1" name="gia" value="0-1000000" <?= ($priceRange === '0-1000000') ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="price-1">Dưới 1 triệu</label>
                        </div>
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" class="custom-control-input" id="price-2" name="gia" value="1000000-3000000" <?= ($priceRange === '1000000-3000000') ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="price-2">1 triệu – 3 triệu</label>
                        </div>
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" class="custom-control-input" id="price-3" name="gia" value="3000000-5000000" <?= ($priceRange === '3000000-5000000') ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="price-3">3 triệu – 5 triệu</label>
                        </div>
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" class="custom-control-input" id="price-4" name="gia" value="5000000-max" <?= ($priceRange === '5000000-max') ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="price-4">Trên 5 triệu</label>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Brand Filter (Ẩn nếu là PC theo logic ASP.NET cũ) -->
                <?php if ($nId != 1 && $nId != 2): ?>
                    <div class="border-bottom mb-4 pb-4">
                        <h6 class="font-weight-bold mb-3 text-dark">Hãng Sản Xuất</h6>
                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" class="custom-control-input" id="brand-all" name="hang" value="0" <?= ($brandId == 0) ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="brand-all">Tất cả hãng</label>
                        </div>
                        <?php foreach ($dsHang as $h): ?>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" class="custom-control-input" id="brand-<?= $h['BrandID'] ?>" name="hang" value="<?= $h['BrandID'] ?>" <?= ($brandId == $h['BrandID']) ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="brand-<?= $h['BrandID'] ?>"><?= htmlspecialchars($h['TenHang']) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="mb-4">
                    <a href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=<?= $nId ?>" class="btn btn-sm btn-outline-secondary btn-block">
                        <i class="fa fa-sync-alt mr-1"></i>Xóa bộ lọc
                    </a>
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

                    <!-- Pagination -->
                    <?php if ($tongSoTrang > 1): ?>
                        <div class="col-12 pb-1">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mb-3">
                                    <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=<?= $nId ?>&gia=<?= urlencode($priceRange) ?>&hang=<?= $brandId ?>&page=<?= $currentPage - 1 ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $tongSoTrang; $i++): ?>
                                        <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                            <a class="page-link" href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=<?= $nId ?>&gia=<?= urlencode($priceRange) ?>&hang=<?= $brandId ?>&page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?= ($currentPage >= $tongSoTrang) ? 'disabled' : '' ?>">
                                        <a class="page-link" href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=<?= $nId ?>&gia=<?= urlencode($priceRange) ?>&hang=<?= $brandId ?>&page=<?= $currentPage + 1 ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>

                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <i class="fa fa-box-open fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Không tìm thấy sản phẩm nào phù hợp với bộ lọc.</h5>
                        <a href="<?= BASE_URL ?>/index.php?controller=SanPham&nId=<?= $nId ?>" class="btn btn-primary mt-3">Xem Tất Cả Sản Phẩm</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
