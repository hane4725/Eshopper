<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-weight-bold text-primary m-0"><i class="fas fa-folder-plus mr-2"></i>Thêm Danh Mục Mới</h3>
    <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDanhMuc" class="btn btn-outline-secondary">
        <i class="fa fa-arrow-left mr-1"></i>Quay lại danh sách
    </a>
</div>

<form action="<?= BASE_URL ?>/admin/index.php?controller=QuanLyDanhMuc&action=them" method="POST" enctype="multipart/form-data" class="bg-white p-4 border rounded shadow-sm" style="max-width: 650px; margin: 0 auto;">
    <div class="form-group mb-3">
        <label class="font-weight-bold">Tên Danh Mục <span class="text-danger">*</span></label>
        <input type="text" name="tenDanhMuc" class="form-control" placeholder="Ví dụ: Tai Nghe Gaming" required>
        <small class="text-muted">Hệ thống sẽ tự động tạo thư mục chứa ảnh sản phẩm không dấu (ví dụ: TaiNgheGaming).</small>
    </div>

    <div class="form-group mb-4">
        <label class="font-weight-bold">Ảnh Banner Danh Mục</label>
        <input type="file" name="anh" class="form-control-file" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold">
        <i class="fa fa-save mr-1"></i>Lưu Danh Mục
    </button>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
