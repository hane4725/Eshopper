<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../includes/navbar.php'; ?>

<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 180px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Chi Tiết Đơn Hàng #<?= $orderId ?></h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="<?= BASE_URL ?>/index.php">Trang Chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0"><a href="<?= BASE_URL ?>/index.php?controller=LichSuDonHang">Lịch Sử Giao Dịch</a></p>
        </div>
    </div>
</div>

<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div class="card border-secondary mb-5 shadow-sm">
                <div class="card-header bg-secondary border-0">
                    <h5 class="font-weight-semi-bold m-0">Danh Sách Mặt Hàng</h5>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Sản Phẩm</th>
                                <th>Đơn Giá</th>
                                <th>Số Lượng</th>
                                <th>Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($chiTiet as $item): ?>
                                <tr>
                                    <td class="text-left d-flex align-items-center">
                                        <img src="<?= BASE_URL . '/' . htmlspecialchars($item['HinhAnh']) ?>" alt="" style="width: 50px; height: 50px; object-fit: contain; margin-right: 15px;">
                                        <span class="font-weight-bold"><?= htmlspecialchars($item['TenSanPham']) ?></span>
                                    </td>
                                    <td class="align-middle text-danger font-weight-bold"><?= number_format($item['DonGia'], 0, ',', '.') ?> đ</td>
                                    <td class="align-middle"><?= $item['SoLuong'] ?></td>
                                    <td class="align-middle text-danger font-weight-bold"><?= number_format($item['ThanhTien'], 0, ',', '.') ?> đ</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-secondary mb-5 shadow-sm">
                <div class="card-header bg-secondary border-0">
                    <h5 class="font-weight-semi-bold m-0">Thông Tin Đơn Hàng</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Mã đơn:</strong> #<?= $donHang['OrderID'] ?></p>
                    <p class="mb-2"><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($donHang['NgayDat'])) ?></p>
                    <p class="mb-2"><strong>Người nhận:</strong> <?= htmlspecialchars($donHang['HoTen']) ?></p>
                    <p class="mb-2"><strong>Điện thoại:</strong> <?= htmlspecialchars($donHang['SoDienThoai']) ?></p>
                    <p class="mb-2"><strong>Địa chỉ:</strong> <?= htmlspecialchars($donHang['DiaChi']) ?></p>
                    <p class="mb-2"><strong>Phương thức:</strong> <?= ($donHang['PhuongThuc'] === 'COD') ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản' ?></p>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5>Tổng thanh toán:</h5>
                        <h5 class="text-danger font-weight-bold"><?= number_format($donHang['TongTien'], 0, ',', '.') ?> đ</h5>
                    </div>
                    <small class="text-muted">(Đã bao gồm 30.000đ phí giao hàng)</small>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="<?= BASE_URL ?>/index.php?controller=LichSuDonHang" class="btn btn-outline-primary btn-block">
                        <i class="fa fa-arrow-left mr-1"></i>Quay Lại Lịch Sử
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
