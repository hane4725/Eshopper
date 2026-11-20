<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../includes/navbar.php'; ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 180px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Đăng Ký Thành Viên</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="<?= BASE_URL ?>/index.php">Trang Chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Đăng Ký</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Register Form Start -->
<div class="container-fluid pt-3 pb-5">
    <div class="row justify-content-center px-xl-5">
        <div class="col-lg-6 col-md-8">
            <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="text-white m-0 font-weight-bold">Tạo Tài Khoản Mới</h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?= BASE_URL ?>/index.php?controller=DangKy&action=xuLyDangKy" method="POST">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Tên Đăng Nhập <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập viết liền không dấu" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold">Mật Khẩu <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold">Xác Nhận Mật Khẩu <span class="text-danger">*</span></label>
                                <input type="password" name="rePassword" class="form-control" placeholder="Nhập lại mật khẩu" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Họ Và Tên <span class="text-danger">*</span></label>
                            <input type="text" name="hoTen" class="form-control" placeholder="Nguyễn Văn A" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold">Số Điện Thoại <span class="text-danger">*</span></label>
                                <input type="text" name="soDienThoai" class="form-control" placeholder="0987654321" required>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="font-weight-bold">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="email@gmail.com">
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Địa Chỉ Giao Hàng</label>
                            <textarea name="diaChi" class="form-control" rows="2" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold shadow-sm">
                            <i class="fa fa-user-plus mr-2"></i>Đăng Ký Tài Khoản
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted">Đã có tài khoản? <a href="<?= BASE_URL ?>/index.php?controller=DangNhap" class="text-primary font-weight-bold">Đăng nhập tại đây</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form End -->

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
