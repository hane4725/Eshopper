<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-weight-bold text-primary m-0"><i class="fas fa-edit mr-2"></i>Chỉnh Sửa Danh Mục #<?= $id ?></h3>
    <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDanhMuc" class="btn btn-outline-secondary">
        <i class="fa fa-arrow-left mr-1"></i>Quay lại danh sách
    </a>
</div>

<form action="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDanhMuc&action=sua&nId=<?= $id ?>" method="POST" enctype="multipart/form-data" class="bg-white p-4 border rounded shadow-sm" style="max-width: 650px; margin: 0 auto;">
    <div class="form-group mb-3">
        <label class="font-weight-bold">Tên Danh Mục <span class="text-danger">*</span></label>
        <input type="text" name="tenDanhMuc" class="form-control" value="<?= htmlspecialchars($dm['TenDanhMuc']) ?>" required>
    </div>

    <div class="form-group mb-3">
        <label class="font-weight-bold">Ảnh Banner Hiện Tại</label>
        <div>
            <?php if (!empty($dm['AnhDM'])): ?>
                <img src="<?= BASE_URL . '/' . htmlspecialchars($dm['AnhDM']) ?>" alt="" style="max-width: 200px; height: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
            <?php else: ?>
                <span class="text-muted">Chưa có banner</span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group mb-4">
        <label class="font-weight-bold">Thay Đổi Ảnh Banner</label>
        <input type="file" name="anh" class="form-control-file" accept="image/*">
        <small class="text-muted">Bỏ trống nếu muốn giữ nguyên banner hiện tại.</small>
    </div>

    <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold">
        <i class="fa fa-save mr-1"></i>Lưu Thay Đổi
    </button>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
