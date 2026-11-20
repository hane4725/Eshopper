<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-weight-bold text-primary m-0"><i class="fas fa-boxes mr-2"></i>Quản Lý Hàng Hóa</h3>
    <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLySanPham&action=them" class="btn btn-success font-weight-bold">
        <i class="fas fa-plus-circle mr-1"></i>Thêm Mới Hàng Hóa
    </a>
</div>

<!-- Lọc theo danh mục & Tìm kiếm -->
<div class="bg-light p-3 rounded mb-4 border">
    <form action="<?= BASE_URL ?>/admin/index.php" method="GET" class="form-row align-items-center">
        <input type="hidden" name="controller" value="QuanLySanPham">
        
        <div class="col-md-4 mb-2 mb-md-0">
            <label class="font-weight-bold mr-2">Chọn Danh Mục:</label>
            <select name="id_dm" class="form-control" onchange="this.form.submit()">
                <?php foreach ($dsDanhMuc as $dm): ?>
                    <option value="<?= $dm['CategoryID'] ?>" <?= ($dm['CategoryID'] == $selectedCatId) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dm['TenDanhMuc']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-5 mb-2 mb-md-0">
            <label class="font-weight-bold mr-2">Tìm kiếm trong danh mục:</label>
            <div class="input-group">
                <input type="text" name="tuKhoa" class="form-control" placeholder="Nhập tên sản phẩm..." value="<?= htmlspecialchars($tuKhoa ?? '') ?>">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 text-right">
            <label class="d-block">&nbsp;</label>
            <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLySanPham&id_dm=<?= $selectedCatId ?>" class="btn btn-outline-secondary">
                <i class="fa fa-sync-alt mr-1"></i>Làm mới
            </a>
        </div>
    </form>
</div>

<!-- Bảng hiển thị danh sách sản phẩm (thay cho GridView trong NoiDung_HH.aspx) -->
<div class="table-responsive">
    <table class="table table-bordered table-hover text-center bg-white shadow-sm">
        <thead class="bg-primary text-white">
            <tr>
                <th>Mã</th>
                <th>Hình Ảnh</th>
                <th>Tên Sản Phẩm</th>
                <th>Đơn Giá</th>
                <th>Tồn Kho</th>
                <th>Hãng SX</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dsSanPham)): ?>
                <?php foreach ($dsSanPham as $sp): ?>
                    <tr>
                        <td class="align-middle font-weight-bold">#<?= $sp['ProductID'] ?></td>
                        <td class="align-middle">
                            <img src="<?= BASE_URL . '/' . htmlspecialchars($sp['HinhAnh']) ?>" alt="" style="width: 60px; height: 60px; object-fit: contain;">
                        </td>
                        <td class="align-middle text-left font-weight-bold">
                            <?= htmlspecialchars($sp['TenSanPham']) ?>
                        </td>
                        <td class="align-middle text-danger font-weight-bold">
                            <?= number_format($sp['Gia'], 0, ',', '.') ?> đ
                        </td>
                        <td class="align-middle">
                            <span class="badge <?= ($sp['SoLuongTon'] > 0) ? 'badge-success' : 'badge-danger' ?> p-2 font-weight-bold">
                                <?= $sp['SoLuongTon'] ?>
                            </span>
                        </td>
                        <td class="align-middle"><?= htmlspecialchars($sp['TenHang'] ?? 'PC (Không hãng)') ?></td>
                        <td class="align-middle">
                            <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLySanPham&action=sua&nId=<?= $sp['ProductID'] ?>" class="btn btn-sm btn-info mr-1">
                                <i class="fa fa-edit"></i> Sửa
                            </a>
                            <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLySanPham&action=xoa&nId=<?= $sp['ProductID'] ?>&id_dm=<?= $selectedCatId ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này? Thư mục ảnh vật lý cũng sẽ bị xóa.')" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-muted py-4">Chưa có sản phẩm nào trong danh mục này hoặc không tìm thấy kết quả.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
