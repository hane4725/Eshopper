<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-weight-bold text-primary m-0"><i class="fas fa-plus-circle mr-2"></i>Thêm Hàng Hóa Mới</h3>
    <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLySanPham" class="btn btn-outline-secondary">
        <i class="fa fa-arrow-left mr-1"></i>Quay lại danh sách
    </a>
</div>

<form action="<?= BASE_URL ?>/admin/index.php?controller=QuanLySanPham&action=them" method="POST" enctype="multipart/form-data" class="bg-white p-4 border rounded shadow-sm">
    <div class="row">
        <div class="col-md-6 form-group">
            <label class="font-weight-bold">Tên Sản Phẩm <span class="text-danger">*</span></label>
            <input type="text" name="tenSanPham" class="form-control" placeholder="Nhập tên sản phẩm..." required>
        </div>

        <div class="col-md-3 form-group">
            <label class="font-weight-bold">Đơn Giá (VNĐ) <span class="text-danger">*</span></label>
            <input type="number" name="donGia" class="form-control" placeholder="Ví dụ: 15000000" min="0" required>
        </div>

        <div class="col-md-3 form-group">
            <label class="font-weight-bold">Số Lượng Tồn Kho <span class="text-danger">*</span></label>
            <input type="number" name="soLuongTon" class="form-control" placeholder="Ví dụ: 50" min="0" required>
        </div>

        <div class="col-md-6 form-group">
            <label class="font-weight-bold">Danh Mục Sản Phẩm <span class="text-danger">*</span></label>
            <select name="idDanhMuc" id="drlDanhMuc" class="form-control" required onchange="handleCategoryChange()">
                <option value="0">-- Hãy Chọn Danh Mục --</option>
                <?php foreach ($dsDanhMuc as $dm): ?>
                    <option value="<?= $dm['CategoryID'] ?>"><?= htmlspecialchars($dm['TenDanhMuc']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6 form-group">
            <label class="font-weight-bold">Hãng Sản Xuất</label>
            <select name="idHang" id="drlHang" class="form-control">
                <option value="0">-- Chọn Hãng Sản Xuất --</option>
                <option value="-1">PC (Không dùng hãng)</option>
                <?php foreach ($dsHang as $h): ?>
                    <option value="<?= $h['BrandID'] ?>"><?= htmlspecialchars($h['TenHang']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-12 form-group">
            <label class="font-weight-bold">Hình Ảnh Sản Phẩm <span class="text-danger">*</span></label>
            <input type="file" name="anh" class="form-control-file" accept="image/*" required>
            <small class="text-muted">Hệ thống sẽ tự động tạo thư mục và phân loại ảnh theo cấu trúc chuẩn.</small>
        </div>

        <div class="col-md-12 form-group">
            <label class="font-weight-bold">Mô Tả Sản Phẩm</label>
            <textarea name="moTa" id="editorMoTa" class="form-control" rows="5"></textarea>
        </div>

        <div class="col-md-12 form-group">
            <label class="font-weight-bold">Thông Số Kỹ Thuật</label>
            <textarea name="thongSoKyThuat" id="editorTSKT" class="form-control" rows="5"></textarea>
        </div>
    </div>

    <div class="text-right mt-3">
        <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold">
            <i class="fa fa-save mr-1"></i>Lưu Sản Phẩm
        </button>
    </div>
</form>

<script>
    CKEDITOR.replace('editorMoTa');
    CKEDITOR.replace('editorTSKT');

    function handleCategoryChange() {
        var catId = document.getElementById('drlDanhMuc').value;
        var hangSelect = document.getElementById('drlHang');
        if (catId == 1 || catId == 2) {
            hangSelect.value = "-1";
            hangSelect.disabled = true;
        } else {
            hangSelect.disabled = false;
        }
    }
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
