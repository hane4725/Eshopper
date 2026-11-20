<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-weight-bold text-primary m-0"><i class="fas fa-users mr-2"></i>Quản Lý Người Dùng & Phân Quyền</h3>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover text-center bg-white shadow-sm">
        <thead class="bg-primary text-white">
            <tr>
                <th>Tên Đăng Nhập</th>
                <th>Họ Và Tên</th>
                <th>Số Điện Thoại</th>
                <th>Email</th>
                <th>Địa Chỉ</th>
                <th style="min-width: 220px;">Cấp Quyền Hệ Thống</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dsNguoiDung)): ?>
                <?php foreach ($dsNguoiDung as $u): ?>
                    <?php $uName = $u['UserName'] ?? $u['Username'] ?? ''; ?>
                    <tr>
                        <td class="align-middle font-weight-bold text-primary"><?= htmlspecialchars($uName) ?></td>
                        <td class="align-middle text-left"><?= htmlspecialchars($u['HoTen']) ?></td>
                        <td class="align-middle"><?= htmlspecialchars($u['SoDienThoai']) ?></td>
                        <td class="align-middle"><?= htmlspecialchars($u['Email']) ?></td>
                        <td class="align-middle text-left"><?= htmlspecialchars($u['DiaChi']) ?></td>
                        <td class="align-middle">
                            <form action="<?= BASE_URL ?>/admin/index.php?controller=QuanLyNguoiDung&action=capNhatQuyen" method="POST" class="d-flex justify-content-center align-items-center">
                                <input type="hidden" name="username" value="<?= htmlspecialchars($uName) ?>">
                                <select name="quyen" class="form-control form-control-sm mr-2 font-weight-bold <?= ($u['Quyen'] == 0) ? 'text-danger' : (($u['Quyen'] == 2) ? 'text-primary' : 'text-dark') ?>" style="width: 140px;">
                                    <option value="0" <?= ($u['Quyen'] == 0) ? 'selected' : '' ?>>Quản Trị Viên (0)</option>
                                    <option value="2" <?= ($u['Quyen'] == 2) ? 'selected' : '' ?>>Nhân Viên (2)</option>
                                    <option value="1" <?= ($u['Quyen'] == 1) ? 'selected' : '' ?>>Khách Hàng (1)</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary" title="Lưu phân quyền">
                                    <i class="fa fa-save"></i>
                                </button>
                            </form>
                        </td>
                        <td class="align-middle">
                            <?php if ($uName !== $_SESSION['User']): ?>
                                <a href="<?= BASE_URL ?>/admin/index.php?controller=QuanLyNguoiDung&action=xoa&user=<?= urlencode($uName) ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i> Xóa
                                </a>
                            <?php else: ?>
                                <span class="badge badge-secondary p-1">Đang đăng nhập</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-muted py-4">Chưa có người dùng nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
