    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="<?= BASE_URL ?>/index.php" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</h1>
                </a>
                <p>Công Nghệ Tiên Phong, Chất Lượng Hàng Đầu.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>56 Tổ 9 Khu 10, Phường Giếng Đáy, TP Hạ Long, Quảng Ninh</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>support@eshopper.vn</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>0868 097 351</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Thông Tin Chung</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Giới Thiệu</a>
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Tuyển Dụng</a>
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Ý Kiến Khách Hàng</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Chính Sách</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Chính Sách Vận Chuyển</a>
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Chính Sách Bảo Hành</a>
                            <a class="text-dark mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Chính Sách Đổi Trả</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Thanh Toán</h5>
                        <p class="text-dark">Hỗ trợ nhận hàng thanh toán (COD) và chuyển khoản ngân hàng 24/7.</p>
                        <img class="img-fluid" src="<?= BASE_URL ?>/img/payments.png" alt="Payments">
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <?= date('Y') ?> Bản quyền thuộc về <a class="text-dark font-weight-semi-bold" href="#">EShopper Store</a>.
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <span class="text-muted">Hệ thống phân phối máy tính & linh kiện hàng đầu</span>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL ?>/lib/easing/easing.min.js"></script>
    <script src="<?= BASE_URL ?>/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= BASE_URL ?>/js/main.js"></script>

    <?php
    $flashSuccess = getFlash('success');
    $flashError = getFlash('error');
    $flashWarning = getFlash('warning');
    ?>
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
    <?php if ($flashWarning): ?>
        <script>
            Swal.fire({
                title: 'Thông Báo',
                text: '<?= addslashes($flashWarning) ?>',
                icon: 'warning',
                confirmButtonText: 'Đồng ý'
            });
        </script>
    <?php endif; ?>
</body>
</html>
