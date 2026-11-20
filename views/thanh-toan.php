<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../includes/navbar.php'; ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 180px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Thanh Toán</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="<?= BASE_URL ?>/index.php">Trang Chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Thanh Toán</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <form action="<?= BASE_URL ?>/index.php?controller=ThanhToan&action=datHang" method="POST">
        <div class="row px-xl-5">
            <div class="col-lg-7">
                <div class="mb-4 bg-white p-4 border shadow-sm" style="border-radius: 8px;">
                    <h4 class="font-weight-semi-bold mb-4 text-primary">Thông Tin Giao Hàng</h4>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="font-weight-bold">Họ Và Tên Người Nhận <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="hoTen" value="<?= htmlspecialchars($userInfo['HoTen'] ?? '') ?>" placeholder="Nhập họ tên đầy đủ" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Số Điện Thoại <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="soDienThoai" value="<?= htmlspecialchars($userInfo['SoDienThoai'] ?? '') ?>" placeholder="0987654321" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="font-weight-bold">Email</label>
                            <input class="form-control" type="email" value="<?= htmlspecialchars($userInfo['Email'] ?? '') ?>" readonly>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="font-weight-bold">Địa Chỉ Giao Hàng <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="diaChi" rows="3" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố" required><?= htmlspecialchars($userInfo['DiaChi'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-secondary mb-5 shadow-sm">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Chi Tiết Đơn Hàng</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Mặt hàng trong giỏ</h5>
                        <?php foreach ($dsGioHang as $item): ?>
                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0 text-truncate" style="max-width: 250px;">
                                    <?= htmlspecialchars($item['TenSanPham']) ?> <span class="text-muted">x <?= $item['SoLuong'] ?></span>
                                </p>
                                <p class="mb-0 font-weight-bold"><?= number_format($item['ThanhTien'], 0, ',', '.') ?> đ</p>
                            </div>
                        <?php endforeach; ?>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-2 pt-1">
                            <h6 class="font-weight-medium">Tiền hàng</h6>
                            <h6 class="font-weight-medium"><?= number_format($tongTienHang, 0, ',', '.') ?> đ</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí giao hàng</h6>
                            <h6 class="font-weight-medium"><?= number_format($phiShip, 0, ',', '.') ?> đ</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng Thanh Toán</h5>
                            <h5 class="font-weight-bold text-danger"><?= number_format($tongThanhToan, 0, ',', '.') ?> đ</h5>
                        </div>
                    </div>
                </div>

                <div class="card border-secondary mb-5 shadow-sm">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Phương Thức Thanh Toán</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="phuongThuc" id="cod" value="COD" checked>
                                <label class="custom-control-label font-weight-bold" for="cod">Thanh toán khi nhận hàng (COD)</label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="phuongThuc" id="bank" value="ChuyenKhoan">
                                <label class="custom-control-label font-weight-bold" for="bank">Chuyển khoản ngân hàng</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">
                            <i class="fa fa-check-circle mr-2"></i>Xác Nhận Đặt Hàng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Checkout End -->

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
