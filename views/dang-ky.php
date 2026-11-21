<?php
require_once __DIR__ . '/../config/config.php';
$flashSuccess = getFlash('success');
$flashError = getFlash('error');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Đăng Ký Tài Khoản - EShopper</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>/img/favicon.ico"/>
    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
    <!-- Custom CSS cho tài khoản chuẩn ASP.NET -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/css-tk/util-tk.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/css-tk/main-tk.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="limiter">
        <div class="container-login100" style="padding-top: 40px; padding-bottom: 40px;">
            <div class="wrap-login100" style="width: 720px;">
                <div class="login100-form-title" style="background-image: url('<?= BASE_URL ?>/css-tk/bg-01.jpg'); padding: 45px 15px;">
                    <span class="login100-form-title-1">
                        ĐĂNG KÝ THÀNH VIÊN
                    </span>
                </div>

                <form class="login100-form validate-form" action="<?= BASE_URL ?>/index.php?controller=DangKy&action=xuLyDangKy" method="POST" style="padding: 35px 60px 45px 160px;">
                    <div class="wrap-input100 validate-input m-b-20">
                        <span class="label-input100">Tài khoản *</span>
                        <input class="input100" type="text" name="username" placeholder="Nhập tên đăng nhập" required autofocus>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-20">
                        <span class="label-input100">Mật khẩu *</span>
                        <input class="input100" type="password" name="password" placeholder="Nhập mật khẩu" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-20">
                        <span class="label-input100">Nhập lại MK *</span>
                        <input class="input100" type="password" name="rePassword" placeholder="Xác nhận lại mật khẩu" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-20">
                        <span class="label-input100">Họ và tên *</span>
                        <input class="input100" type="text" name="hoTen" placeholder="Nhập họ và tên đầy đủ" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-20">
                        <span class="label-input100">Điện thoại *</span>
                        <input class="input100" type="text" name="soDienThoai" placeholder="Nhập số điện thoại" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-20">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="Nhập email liên hệ">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26">
                        <span class="label-input100">Địa chỉ</span>
                        <input class="input100" type="text" name="diaChi" placeholder="Nhập địa chỉ nhận hàng">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-25">
                        <div>
                            <a href="<?= BASE_URL ?>/index.php?controller=TrangChu" class="txt1 text-primary">
                                <i class="fa fa-home mr-1"></i>Về Trang Chủ
                            </a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Đăng Ký Tài Khoản
                        </button>
                    </div>

                    <div class="w-full text-center p-t-25">
                        <span class="txt1">
                            Đã có tài khoản?
                        </span>
                        <a href="<?= BASE_URL ?>/index.php?controller=DangNhap" class="txt1 text-primary font-weight-bold ml-1">
                            Đăng nhập ngay
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if ($flashSuccess): ?>
        <script>
            Swal.fire({
                title: 'Thành Công!',
                text: '<?= addslashes($flashSuccess) ?>',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>
    <?php if ($flashError): ?>
        <script>
            Swal.fire({
                title: 'Lỗi!',
                text: '<?= addslashes($flashError) ?>',
                icon: 'error',
                confirmButtonText: 'Đóng'
            });
        </script>
    <?php endif; ?>
</body>
</html>
