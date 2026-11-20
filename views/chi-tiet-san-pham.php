<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../includes/navbar.php'; ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 180px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Chi Tiết Sản Phẩm</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="<?= BASE_URL ?>/index.php">Trang Chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0"><?= htmlspecialchars($sanPham['TenDanhMuc'] ?? '') ?></p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div class="border text-center p-3 bg-white shadow-sm" style="border-radius: 8px;">
                <img class="w-100 h-100" style="max-height: 400px; object-fit: contain;" src="<?= BASE_URL . '/' . htmlspecialchars($sanPham['HinhAnh']) ?>" alt="<?= htmlspecialchars($sanPham['TenSanPham']) ?>">
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold"><?= htmlspecialchars($sanPham['TenSanPham']) ?></h3>
            <p class="text-muted mb-2">Danh mục: <strong><?= htmlspecialchars($sanPham['TenDanhMuc'] ?? 'Khác') ?></strong> | Hãng: <strong><?= htmlspecialchars($sanPham['TenHang'] ?? 'Chính hãng') ?></strong></p>
            <h3 class="font-weight-semi-bold mb-4 text-danger"><?= number_format($sanPham['Gia'], 0, ',', '.') ?> đ</h3>

            <div class="mb-4">
                <span class="badge <?= ($sanPham['SoLuongTon'] > 0) ? 'badge-success' : 'badge-danger' ?> p-2 font-weight-bold">
                    <?= ($sanPham['SoLuongTon'] > 0) ? 'Còn hàng (' . $sanPham['SoLuongTon'] . ' sản phẩm)' : 'Hết hàng' ?>
                </span>
            </div>

            <form action="<?= BASE_URL ?>/index.php?controller=ChiTietSanPham&action=themVaoGio" method="POST">
                <input type="hidden" name="productId" value="<?= $sanPham['ProductID'] ?>">
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 140px;">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-minus" onclick="decreaseQty()">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="number" id="txtSoLuong" name="soLuong" class="form-control bg-secondary text-center" value="1" min="1" max="<?= $sanPham['SoLuongTon'] ?>">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-plus" onclick="increaseQty(<?= $sanPham['SoLuongTon'] ?>)">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <?php if ($sanPham['SoLuongTon'] > 0): ?>
                        <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold">
                            <i class="fa fa-shopping-cart mr-2"></i>Chọn Mua
                        </button>
                    <?php else: ?>
                        <button type="button" class="btn btn-secondary px-4 py-2" disabled>Hết Hàng</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Tab Description and Specs -->
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active font-weight-bold" data-toggle="tab" href="#tab-pane-1">Mô Tả Sản Phẩm</a>
                <a class="nav-item nav-link font-weight-bold" data-toggle="tab" href="#tab-pane-2">Thông Số Kỹ Thuật</a>
            </div>
            <div class="tab-content bg-white p-4 border shadow-sm" style="border-radius: 8px;">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3 font-weight-bold">Mô Tả Chi Tiết</h4>
                    <div>
                        <?= !empty($sanPham['MoTa']) ? $sanPham['MoTa'] : '<p class="text-muted">Đang cập nhật mô tả cho sản phẩm này.</p>' ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-pane-2">
                    <h4 class="mb-3 font-weight-bold">Thông Số Kỹ Thuật</h4>
                    <div>
                        <?= !empty($sanPham['ThongSoKyThuat']) ? $sanPham['ThongSoKyThuat'] : '<p class="text-muted">Đang cập nhật thông số kỹ thuật.</p>' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->

<!-- Products Start (Có thể bạn sẽ thích) -->
<?php if (!empty($spLienQuan)): ?>
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Có Thể Bạn Sẽ Thích</span></h2>
        </div>
        <div class="row px-xl-5">
            <?php foreach ($spLienQuan as $item): ?>
                <?php if ($item['ProductID'] != $sanPham['ProductID']): ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4 shadow-sm">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0" style="height: 220px;">
                                <img class="img-fluid w-100 h-100" style="object-fit: contain;" src="<?= BASE_URL . '/' . htmlspecialchars($item['HinhAnh']) ?>" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3 px-2 font-weight-bold"><?= htmlspecialchars($item['TenSanPham']) ?></h6>
                                <div class="d-flex justify-content-center">
                                    <h6 class="text-danger font-weight-bold"><?= number_format($item['Gia'], 0, ',', '.') ?> đ</h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="<?= BASE_URL ?>/index.php?controller=ChiTietSanPham&nId=<?= $item['ProductID'] ?>" class="btn btn-sm text-dark p-0">
                                    <i class="fas fa-eye text-primary mr-1"></i>Xem Chi Tiết
                                </a>
                                <a href="<?= BASE_URL ?>/index.php?controller=TrangChu&action=themGioNhanh&id=<?= $item['ProductID'] ?>" class="btn btn-sm text-dark p-0">
                                    <i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Giỏ
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<script>
    function decreaseQty() {
        var input = document.getElementById('txtSoLuong');
        var val = parseInt(input.value) || 1;
        if (val > 1) {
            input.value = val - 1;
        }
    }
    function increaseQty(max) {
        var input = document.getElementById('txtSoLuong');
        var val = parseInt(input.value) || 1;
        if (val < max) {
            input.value = val + 1;
        } else {
            Swal.fire({
                title: 'Thông báo',
                text: 'Kho chỉ còn tối đa ' + max + ' sản phẩm!',
                icon: 'warning'
            });
        }
    }
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
