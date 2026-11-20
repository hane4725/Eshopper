<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-weight-bold text-primary m-0"><i class="fas fa-receipt mr-2"></i>Chi Tiết Đơn Hàng #<?= $id ?></h3>
    <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDonHang" class="btn btn-outline-secondary">
        <i class="fa fa-arrow-left mr-1"></i>Quay lại danh sách đơn hàng
    </a>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm p-3 bg-light">
            <h5 class="font-weight-bold text-dark border-bottom pb-2">Thông Tin Khách Hàng</h5>
            <p class="mb-2"><strong>Mã đơn hàng:</strong> <span class="text-primary font-weight-bold">#<?= $donHang['OrderID'] ?></span></p>
            <p class="mb-2"><strong>Tài khoản đặt:</strong> <?= htmlspecialchars($donHang['UserName'] ?? $donHang['Username'] ?? '') ?></p>
            <p class="mb-2"><strong>Họ tên người nhận:</strong> <?= htmlspecialchars($donHang['HoTen']) ?></p>
            <p class="mb-2"><strong>Số điện thoại:</strong> <?= htmlspecialchars($donHang['SoDienThoai']) ?></p>
            <p class="mb-2"><strong>Địa chỉ giao hàng:</strong> <?= htmlspecialchars($donHang['DiaChi']) ?></p>
            <p class="mb-2"><strong>Phương thức:</strong> <?= ($donHang['PhuongThuc'] === 'COD') ? 'Thanh toán khi nhận hàng (COD)' : 'Chuyển khoản' ?></p>
            <p class="mb-2"><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i:s', strtotime($donHang['NgayDat'])) ?></p>
            <hr>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-bold">Tổng thanh toán:</h5>
                <h5 class="text-danger font-weight-bold"><?= number_format($donHang['TongTien'], 0, ',', '.') ?> đ</h5>
            </div>
            <small class="text-muted">(Đã bao gồm 30.000đ tiền ship)</small>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <h5 class="font-weight-bold text-dark border-bottom pb-2">Danh Sách Mặt Hàng Đặt Mua</h5>
            <div class="table-responsive">
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
                        <?php $tongTienHang = 0; ?>
                        <?php foreach ($chiTiet as $item): ?>
                            <?php $tongTienHang += (float)$item['ThanhTien']; ?>
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
                        <tr class="bg-light font-weight-bold">
                            <td colspan="3" class="text-right">Tiền hàng:</td>
                            <td class="text-danger"><?= number_format($tongTienHang, 0, ',', '.') ?> đ</td>
                        </tr>
                        <tr class="bg-light font-weight-bold">
                            <td colspan="3" class="text-right">Phí giao hàng:</td>
                            <td class="text-danger">30.000 đ</td>
                        </tr>
                        <tr class="bg-secondary font-weight-bold text-dark">
                            <td colspan="3" class="text-right">TỔNG CỘNG:</td>
                            <td class="text-danger font-weight-bold h5 mb-0"><?= number_format($tongTienHang + 30000, 0, ',', '.') ?> đ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
