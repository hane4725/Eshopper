        </div>
    </main>

    <footer class="admin-footer">
        <p class="m-0">&copy; <?= date('Y') ?> Eshopper Management - Bản quyền của Công ty TNHH Công nghệ và Truyền thông Hoàng Đức</p>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

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
