<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../includes/navbar.php'; ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 180px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Kết Quả Tìm Kiếm</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="<?= BASE_URL ?>/index.php">Trang Chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Từ khóa: <strong class="text-primary">"<?= htmlspecialchars($tuKhoa) ?>"</strong></p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Search Results Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <?php if (!empty($dsSanPham)): ?>
            <?php foreach ($dsSanPham as $sp): ?>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4 shadow-sm">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0" style="height: 230px;">
                            <img class="img-fluid w-100 h-100" style="object-fit: contain;" src="<?= BASE_URL . '/' . htmlspecialchars($sp['HinhAnh']) ?>" alt="">
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
                                <a class="page-link" href="<?= BASE_URL ?>/index.php?controller=TimKiem&q=<?= urlencode($tuKhoa) ?>&page=<?= $currentPage - 1 ?>">Trước</a>
                            </li>
                            <?php for ($i = 1; $i <= $tongSoTrang; $i++): ?>
                                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= BASE_URL ?>/index.php?controller=TimKiem&q=<?= urlencode($tuKhoa) ?>&page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= ($currentPage >= $tongSoTrang) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= BASE_URL ?>/index.php?controller=TimKiem&q=<?= urlencode($tuKhoa) ?>&page=<?= $currentPage + 1 ?>">Sau</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="col-12 text-center py-5 bg-white shadow-sm" style="border-radius: 8px;">
                <i class="fa fa-search fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Không tìm thấy sản phẩm nào khớp với từ khóa "<?= htmlspecialchars($tuKhoa) ?>"!</h4>
                <p class="text-muted mb-4">Vui lòng thử tìm kiếm với từ khóa khác.</p>
                <a href="<?= BASE_URL ?>/index.php?controller=TrangChu" class="btn btn-primary px-4 py-2 font-weight-bold">Về Trang Chủ</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- Search Results End -->

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
