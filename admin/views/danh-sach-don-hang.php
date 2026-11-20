<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-weight-bold text-primary m-0"><i class="fas fa-file-invoice mr-2"></i>Quản Lý Đơn Hàng</h3>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover text-center bg-white shadow-sm">
        <thead class="bg-primary text-white">
            <tr>
                <th>Mã Đơn</th>
                <th>Ngày Đặt</th>
                <th>Khách Hàng</th>
                <th>Số Điện Thoại</th>
                <th>Địa Chỉ</th>
                <th>Tổng Tiền</th>
                <th>Phương Thức</th>
                <th style="min-width: 220px;">Trạng Thái Đơn Hàng</th>
                <th>Chi Tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dsDonHang)): ?>
                <?php foreach ($dsDonHang as $dh): ?>
                    <tr>
                        <td class="align-middle font-weight-bold text-primary">#<?= $dh['OrderID'] ?></td>
                        <td class="align-middle"><?= date('d/m/Y H:i', strtotime($dh['NgayDat'])) ?></td>
                        <td class="align-middle"><?= htmlspecialchars($dh['HoTen']) ?></td>
                        <td class="align-middle"><?= htmlspecialchars($dh['SoDienThoai']) ?></td>
                        <td class="align-middle text-left"><?= htmlspecialchars($dh['DiaChi']) ?></td>
                        <td class="align-middle font-weight-bold text-danger"><?= number_format($dh['TongTien'], 0, ',', '.') ?> đ</td>
                        <td class="align-middle">
                            <span class="badge badge-light border"><?= ($dh['PhuongThuc'] === 'COD') ? 'COD' : 'Chuyển Khoản' ?></span>
                        </td>
                        <td class="align-middle">
                            <form action="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDonHang&action=capNhat" method="POST" class="d-flex justify-content-center align-items-center">
                                <input type="hidden" name="orderId" value="<?= $dh['OrderID'] ?>">
                                <select name="trangThai" class="form-control form-control-sm mr-2 font-weight-bold <?= ($dh['TrangThai'] == 2) ? 'text-success' : (($dh['TrangThai'] == 3) ? 'text-danger' : 'text-warning') ?>" style="width: 140px;">
                                    <option value="0" <?= ($dh['TrangThai'] == 0) ? 'selected' : '' ?>>Đang xử lý</option>
                                    <option value="1" <?= ($dh['TrangThai'] == 1) ? 'selected' : '' ?>>Đang giao hàng</option>
                                    <option value="2" <?= ($dh['TrangThai'] == 2) ? 'selected' : '' ?>>Đã hoàn thành</option>
                                    <option value="3" <?= ($dh['TrangThai'] == 3) ? 'selected' : '' ?>>Đã hủy</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary" title="Lưu trạng thái">
                                    <i class="fa fa-save"></i>
                                </button>
                            </form>
                        </td>
                        <td class="align-middle">
                            <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDonHang&action=chiTiet&id=<?= $dh['OrderID'] ?>" class="btn btn-sm btn-info">
                                <i class="fa fa-eye mr-1"></i>Xem
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-muted py-4">Chưa có đơn hàng nào trong hệ thống.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
