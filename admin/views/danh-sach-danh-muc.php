<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-weight-bold text-primary m-0"><i class="fas fa-tags mr-2"></i>Quản Lý Danh Mục</h3>
    <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDanhMuc&action=them" class="btn btn-success font-weight-bold">
        <i class="fas fa-plus-circle mr-1"></i>Thêm Mới Danh Mục
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover text-center bg-white shadow-sm">
        <thead class="bg-primary text-white">
            <tr>
                <th>Mã Danh Mục</th>
                <th>Hình Ảnh Banner</th>
                <th>Tên Danh Mục</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dsDanhMuc)): ?>
                <?php foreach ($dsDanhMuc as $dm): ?>
                    <tr>
                        <td class="align-middle font-weight-bold">#<?= $dm['CategoryID'] ?></td>
                        <td class="align-middle">
                            <?php if (!empty($dm['AnhDM'])): ?>
                                <img src="<?= BASE_URL . '/' . htmlspecialchars($dm['AnhDM']) ?>" alt="" style="width: 100px; height: 50px; object-fit: cover; border-radius: 4px;">
                            <?php else: ?>
                                <span class="text-muted">Không có ảnh</span>
                            <?php endif; ?>
                        </td>
                        <td class="align-middle font-weight-bold text-left"><?= htmlspecialchars($dm['TenDanhMuc']) ?></td>
                        <td class="align-middle">
                            <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDanhMuc&action=sua&nId=<?= $dm['CategoryID'] ?>" class="btn btn-sm btn-info mr-1">
                                <i class="fa fa-edit"></i> Sửa
                            </a>
                            <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDanhMuc&action=xoa&nId=<?= $dm['CategoryID'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này? Thư mục ảnh liên quan cũng sẽ bị xóa.')" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-muted py-4">Chưa có danh mục nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
