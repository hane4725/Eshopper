<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../includes/navbar.php'; ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 180px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Giỏ Hàng Của Bạn</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="<?= BASE_URL ?>/index.php">Trang Chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Giỏ Hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <?php if (!empty($dsGioHang)): ?>
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0 bg-white shadow-sm">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Sản Phẩm</th>
                            <th>Đơn Giá</th>
                            <th>Số Lượng</th>
                            <th>Thành Tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php foreach ($dsGioHang as $item): ?>
                            <tr>
                                <td class="align-middle text-left d-flex align-items-center">
                                    <img src="<?= BASE_URL . '/' . htmlspecialchars($item['HinhAnh']) ?>" alt="" style="width: 50px; height: 50px; object-fit: contain; margin-right: 15px;">
                                    <span class="font-weight-bold"><?= htmlspecialchars($item['TenSanPham']) ?></span>
                                </td>
                                <td class="align-middle text-danger font-weight-bold"><?= number_format($item['Gia'], 0, ',', '.') ?> đ</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <a href="<?= BASE_URL ?>/index.php?controller=GioHang&action=giam&id=<?= $item['ProductID'] ?>&qty=<?= $item['SoLuong'] ?>" class="btn btn-sm btn-primary">
                                                <i class="fa fa-minus"></i>
                                            </a>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary text-center" value="<?= $item['SoLuong'] ?>" readonly>
                                        <div class="input-group-btn">
                                            <a href="<?= BASE_URL ?>/index.php?controller=GioHang&action=tang&id=<?= $item['ProductID'] ?>&qty=<?= $item['SoLuong'] ?>" class="btn btn-sm btn-primary">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-danger font-weight-bold"><?= number_format($item['ThanhTien'], 0, ',', '.') ?> đ</td>
                                <td class="align-middle">
                                    <a href="<?= BASE_URL ?>/index.php?controller=GioHang&action=xoa&id=<?= $item['ProductID'] ?>" onclick="return confirm('Bạn có chắc muốn xóa món này?')" class="btn btn-sm btn-danger">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-lg-4">
                <div class="card border-secondary mb-5 shadow-sm">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Tóm Tắt Giỏ Hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Tiền hàng</h6>
                            <h6 class="font-weight-medium"><?= number_format($tongTien, 0, ',', '.') ?> đ</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí giao hàng</h6>
                            <h6 class="font-weight-medium">30.000 đ</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng thanh toán</h5>
                            <h5 class="font-weight-bold text-danger"><?= number_format($tongTien + 30000, 0, ',', '.') ?> đ</h5>
                        </div>
                        <a href="<?= BASE_URL ?>/index.php?controller=ThanhToan" class="btn btn-block btn-primary my-3 py-3 font-weight-bold">
                            Tiến Hành Thanh Toán
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-12 text-center py-5 bg-white shadow-sm" style="border-radius: 8px;">
                <i class="fa fa-shopping-cart fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Giỏ hàng của bạn đang trống!</h4>
                <p class="text-muted mb-4">Hãy chọn những sản phẩm ưng ý để thêm vào giỏ nhé.</p>
                <a href="<?= BASE_URL ?>/index.php?controller=TrangChu" class="btn btn-primary px-4 py-2 font-weight-bold">Tiếp Tục Mua Sắm</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- Cart End -->

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
