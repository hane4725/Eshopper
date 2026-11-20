<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-weight-bold text-primary m-0"><i class="fas fa-plus-square mr-2"></i>Thêm Hãng Sản Xuất Mới</h3>
    <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyHang" class="btn btn-outline-secondary">
        <i class="fa fa-arrow-left mr-1"></i>Quay lại danh sách
    </a>
</div>

<form action="<?= BASE_URL ?>/admin/index.php?controller=QuanLyHang&action=them" method="POST" class="bg-white p-4 border rounded shadow-sm" style="max-width: 600px; margin: 0 auto;">
    <div class="form-group mb-4">
        <label class="font-weight-bold">Tên Hãng Sản Xuất <span class="text-danger">*</span></label>
        <input type="text" name="tenHang" class="form-control" placeholder="Ví dụ: Logitech, Razer, ASUS..." required autofocus>
    </div>

    <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold">
        <i class="fa fa-save mr-1"></i>Lưu Hãng Sản Xuất
    </button>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
