<?php require_once __DIR__ . '/../includes/header.php'; ?>
<?php require_once __DIR__ . '/../includes/navbar.php'; ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 180px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Đăng Nhập Tài Khoản</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="<?= BASE_URL ?>/index.php">Trang Chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Đăng Nhập</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Login Form Start -->
<div class="container-fluid pt-3 pb-5">
    <div class="row justify-content-center px-xl-5">
        <div class="col-lg-5 col-md-8">
            <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="text-white m-0 font-weight-bold">Đăng Nhập EShopper</h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?= BASE_URL ?>/index.php?controller=DangNhap&action=xuLyDangNhap" method="POST">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Tên Đăng Nhập</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="username" class="form-control" placeholder="Nhập tên đăng nhập..." required autofocus>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Mật Khẩu</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu..." required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold shadow-sm">
                            <i class="fa fa-sign-in-alt mr-2"></i>Đăng Nhập
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted">Chưa có tài khoản? <a href="<?= BASE_URL ?>/index.php?controller=DangKy" class="text-primary font-weight-bold">Đăng ký ngay</a></p>
                        <small class="text-muted d-block mt-2">(Tài khoản Admin mặc định: <strong>Admin</strong> / <strong>1</strong>)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Form End -->

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
