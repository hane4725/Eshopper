<?php require_once __DIR__ . '/../includes/header.php'; ?>

<h3 class="font-weight-bold mb-4 text-primary"><i class="fas fa-chart-line mr-2"></i>Tổng Quan Hệ Thống</h3>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white p-3 shadow-sm" style="border-radius: 10px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase m-0">Sản Phẩm</h6>
                    <h2 class="font-weight-bold m-0 mt-2"><?= $tongSP ?></h2>
                </div>
                <i class="fas fa-boxes fa-3x opacity-50"></i>
            </div>
            <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLySanPham" class="text-white mt-3 d-block small">Quản lý sản phẩm <i class="fa fa-arrow-right ml-1"></i></a>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white p-3 shadow-sm" style="border-radius: 10px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase m-0">Đơn Hàng</h6>
                    <h2 class="font-weight-bold m-0 mt-2"><?= $tongDH ?></h2>
                </div>
                <i class="fas fa-file-invoice fa-3x opacity-50"></i>
            </div>
            <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDonHang" class="text-white mt-3 d-block small">Quản lý đơn hàng <i class="fa fa-arrow-right ml-1"></i></a>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-white p-3 shadow-sm" style="border-radius: 10px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase m-0">Người Dùng</h6>
                    <h2 class="font-weight-bold m-0 mt-2"><?= $tongUser ?></h2>
                </div>
                <i class="fas fa-users fa-3x opacity-50"></i>
            </div>
            <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyNguoiDung" class="text-white mt-3 d-block small">Quản lý tài khoản <i class="fa fa-arrow-right ml-1"></i></a>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white p-3 shadow-sm" style="border-radius: 10px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase m-0">Danh Mục</h6>
                    <h2 class="font-weight-bold m-0 mt-2"><?= $tongDM ?></h2>
                </div>
                <i class="fas fa-tags fa-3x opacity-50"></i>
            </div>
            <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDanhMuc" class="text-white mt-3 d-block small">Quản lý danh mục <i class="fa fa-arrow-right ml-1"></i></a>
        </div>
    </div>
</div>

<div class="mt-4">
    <h5 class="font-weight-bold mb-3"><i class="fas fa-clock mr-1"></i>Đơn Hàng Gần Đây</h5>
    <div class="table-responsive">
        <table class="table table-bordered text-center mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Mã Đơn</th>
                    <th>Ngày Đặt</th>
                    <th>Khách Hàng</th>
                    <th>Số Điện Thoại</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($donHangMoi)): ?>
                    <?php foreach ($donHangMoi as $dh): ?>
                        <tr>
                            <td class="font-weight-bold text-primary">#<?= $dh['OrderID'] ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($dh['NgayDat'])) ?></td>
                            <td><?= htmlspecialchars($dh['HoTen']) ?></td>
                            <td><?= htmlspecialchars($dh['SoDienThoai']) ?></td>
                            <td class="text-danger font-weight-bold"><?= number_format($dh['TongTien'], 0, ',', '.') ?> đ</td>
                            <td>
                                <?php
                                switch ($dh['TrangThai']) {
                                    case 0: echo '<span class="badge badge-warning p-2">Đang xử lý</span>'; break;
                                    case 1: echo '<span class="badge badge-info p-2">Đang giao</span>'; break;
                                    case 2: echo '<span class="badge badge-success p-2">Hoàn thành</span>'; break;
                                    case 3: echo '<span class="badge badge-danger p-2">Đã hủy</span>'; break;
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDonHang&action=chiTiet&id=<?= $dh['OrderID'] ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-eye"></i> Xem
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-muted">Chưa có đơn hàng nào trong hệ thống.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
