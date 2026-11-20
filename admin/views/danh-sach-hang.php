<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-weight-bold text-primary m-0"><i class="fas fa-copyright mr-2"></i>Quản Lý Hãng Sản Xuất</h3>
    <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyHang&action=them" class="btn btn-success font-weight-bold">
        <i class="fas fa-plus-circle mr-1"></i>Thêm Mới Hãng SX
    </a>
</div>

<div class="table-responsive" style="max-width: 800px; margin: 0 auto;">
    <table class="table table-bordered table-hover text-center bg-white shadow-sm">
        <thead class="bg-primary text-white">
            <tr>
                <th>Mã Hãng</th>
                <th>Tên Hãng Sản Xuất</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dsHang)): ?>
                <?php foreach ($dsHang as $h): ?>
                    <tr>
                        <td class="align-middle font-weight-bold">#<?= $h['BrandID'] ?></td>
                        <td class="align-middle font-weight-bold text-left"><?= htmlspecialchars($h['TenHang']) ?></td>
                        <td class="align-middle">
                            <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyHang&action=sua&nId=<?= $h['BrandID'] ?>" class="btn btn-sm btn-info mr-1">
                                <i class="fa fa-edit"></i> Sửa
                            </a>
                            <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyHang&action=xoa&nId=<?= $h['BrandID'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa hãng này?')" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-muted py-4">Chưa có hãng sản xuất nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
