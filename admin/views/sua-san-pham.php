<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-weight-bold text-primary m-0"><i class="fas fa-edit mr-2"></i>Chỉnh Sửa Hàng Hóa #<?= $id ?></h3>
    <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLySanPham&id_dm=<?= $sp['CategoryID'] ?>" class="btn btn-outline-secondary">
        <i class="fa fa-arrow-left mr-1"></i>Quay lại danh sách
    </a>
</div>

<form action="<?= BASE_URL ?>/admin/index.php?controller=QuanLySanPham&action=sua&nId=<?= $id ?>" method="POST" enctype="multipart/form-data" class="bg-white p-4 border rounded shadow-sm">
    <div class="row">
        <div class="col-md-6 form-group">
            <label class="font-weight-bold">Tên Sản Phẩm <span class="text-danger">*</span></label>
            <input type="text" name="tenSanPham" class="form-control" value="<?= htmlspecialchars($sp['TenSanPham']) ?>" required>
        </div>

        <div class="col-md-3 form-group">
            <label class="font-weight-bold">Đơn Giá (VNĐ) <span class="text-danger">*</span></label>
            <input type="number" name="donGia" class="form-control" value="<?= (int)$sp['Gia'] ?>" min="0" required>
        </div>

        <div class="col-md-3 form-group">
            <label class="font-weight-bold">Số Lượng Tồn Kho <span class="text-danger">*</span></label>
            <input type="number" name="soLuongTon" class="form-control" value="<?= (int)$sp['SoLuongTon'] ?>" min="0" required>
        </div>

        <div class="col-md-6 form-group">
            <label class="font-weight-bold">Danh Mục Sản Phẩm <span class="text-danger">*</span></label>
            <select name="idDanhMuc" id="drlDanhMuc" class="form-control" required onchange="handleCategoryChange()">
                <?php foreach ($dsDanhMuc as $dm): ?>
                    <option value="<?= $dm['CategoryID'] ?>" <?= ($dm['CategoryID'] == $sp['CategoryID']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dm['TenDanhMuc']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6 form-group">
            <label class="font-weight-bold">Hãng Sản Xuất</label>
            <select name="idHang" id="drlHang" class="form-control">
                <option value="-1" <?= ($sp['BrandID'] == 0) ? 'selected' : '' ?>>PC (Không dùng hãng)</option>
                <?php foreach ($dsHang as $h): ?>
                    <option value="<?= $h['BrandID'] ?>" <?= ($h['BrandID'] == $sp['BrandID']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($h['TenHang']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6 form-group">
            <label class="font-weight-bold">Hình Ảnh Hiện Tại</label>
            <div class="d-flex align-items-center">
                <img src="<?= BASE_URL . '/' . htmlspecialchars($sp['HinhAnh']) ?>" alt="" style="width: 100px; height: 100px; object-fit: contain; border: 1px solid #ddd; padding: 5px; border-radius: 5px;" class="mr-3">
                <span class="text-muted small"><?= htmlspecialchars($sp['HinhAnh']) ?></span>
            </div>
        </div>

        <div class="col-md-6 form-group">
            <label class="font-weight-bold">Thay Đổi Hình Ảnh Mới (Nếu có)</label>
            <input type="file" name="anh" class="form-control-file" accept="image/*">
            <small class="text-muted d-block mt-2">Bỏ trống ô này nếu bạn muốn giữ nguyên ảnh hiện tại.</small>
        </div>

        <div class="col-md-12 form-group">
            <label class="font-weight-bold">Mô Tả Sản Phẩm</label>
            <textarea name="moTa" id="editorMoTa" class="form-control" rows="5"><?= htmlspecialchars($sp['MoTa']) ?></textarea>
        </div>

        <div class="col-md-12 form-group">
            <label class="font-weight-bold">Thông Số Kỹ Thuật</label>
            <textarea name="thongSoKyThuat" id="editorTSKT" class="form-control" rows="5"><?= htmlspecialchars($sp['ThongSoKyThuat']) ?></textarea>
        </div>
    </div>

    <div class="text-right mt-3">
        <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold">
            <i class="fa fa-save mr-1"></i>Lưu Thay Đổi
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
    handleCategoryChange();
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
