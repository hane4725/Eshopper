<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../includes/navbar.php'; ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 180px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Lịch Sử Giao Dịch</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="<?= BASE_URL ?>/index.php">Trang Chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Lịch Sử Đơn Hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Order History Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-12 table-responsive mb-5">
            <?php if (!empty($dsDonHang)): ?>
                <table class="table table-bordered text-center mb-0 bg-white shadow-sm">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Mã Đơn</th>
                            <th>Ngày Đặt</th>
                            <th>Người Nhận</th>
                            <th>Số Điện Thoại</th>
                            <th>Địa Chỉ</th>
                            <th>Tổng Tiền</th>
                            <th>Phương Thức</th>
                            <th>Trạng Thái</th>
                            <th>Chi Tiết</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php foreach ($dsDonHang as $dh): ?>
                            <?php
                            $statusClass = 'badge-secondary';
                            $statusText = 'Không xác định';
                            switch ($dh['TrangThai']) {
                                case 0: $statusClass = 'badge-warning'; $statusText = 'Đang xử lý'; break;
                                case 1: $statusClass = 'badge-info'; $statusText = 'Đang giao hàng'; break;
                                case 2: $statusClass = 'badge-success'; $statusText = 'Đã hoàn thành'; break;
                                case 3: $statusClass = 'badge-danger'; $statusText = 'Đã hủy'; break;
                            }
                            ?>
                            <tr>
                                <td class="align-middle font-weight-bold text-primary">#<?= $dh['OrderID'] ?></td>
                                <td class="align-middle"><?= date('d/m/Y H:i', strtotime($dh['NgayDat'])) ?></td>
                                <td class="align-middle"><?= htmlspecialchars($dh['HoTen']) ?></td>
                                <td class="align-middle"><?= htmlspecialchars($dh['SoDienThoai']) ?></td>
                                <td class="align-middle text-left"><?= htmlspecialchars($dh['DiaChi']) ?></td>
                                <td class="align-middle font-weight-bold text-danger"><?= number_format($dh['TongTien'], 0, ',', '.') ?> đ</td>
                                <td class="align-middle">
                                    <span class="badge badge-light border"><?= ($dh['PhuongThuc'] === 'COD') ? 'Nhận hàng (COD)' : 'Chuyển khoản' ?></span>
                                </td>
                                <td class="align-middle">
                                    <span class="badge <?= $statusClass ?> p-2 font-weight-bold"><?= $statusText ?></span>
                                </td>
                                <td class="align-middle">
                                    <a href="<?= BASE_URL ?>/index.php?controller=LichSuDonHang&action=chiTiet&id=<?= $dh['OrderID'] ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-eye mr-1"></i>Xem
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="col-12 text-center py-5 bg-white shadow-sm" style="border-radius: 8px;">
                    <i class="fa fa-receipt fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Bạn chưa có đơn hàng nào!</h4>
                    <p class="text-muted mb-4">Các đơn hàng bạn đã đặt sẽ được lưu trữ và hiển thị tại đây.</p>
                    <a href="<?= BASE_URL ?>/index.php?controller=TrangChu" class="btn btn-primary px-4 py-2 font-weight-bold">Mua Hàng Ngay</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Order History End -->

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
