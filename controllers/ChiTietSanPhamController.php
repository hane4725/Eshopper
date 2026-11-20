<?php
require_once __DIR__ . '/../models/SanPhamModel.php';
require_once __DIR__ . '/../models/GioHangModel.php';

class ChiTietSanPhamController {
    public function index() {
        $id = isset($_GET['nId']) ? (int)$_GET['nId'] : 0;
        if ($id <= 0) {
            redirect(BASE_URL . '/index.php?controller=TrangChu');
        }

        $sanPhamModel = new SanPhamModel();
        $sanPham = $sanPhamModel->layChiTietSanPham($id);

        if (!$sanPham) {
            setFlash('error', 'Sản phẩm không tồn tại!');
            redirect(BASE_URL . '/index.php?controller=TrangChu');
        }

        // Lấy các sản phẩm liên quan trong cùng danh mục
        $spLienQuan = $sanPhamModel->laySanPhamTheoDanhMuc($sanPham['CategoryID'], 5, 0);

        $pageTitle = $sanPham['TenSanPham'];
        require_once __DIR__ . '/../views/chi-tiet-san-pham.php';
    }

    public function themVaoGio() {
        if (!isset($_SESSION['User'])) {
            setFlash('warning', 'Vui lòng đăng nhập để mua hàng!');
            redirect(BASE_URL . '/index.php?controller=DangNhap');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = isset($_POST['productId']) ? (int)$_POST['productId'] : 0;
            $soLuong = isset($_POST['soLuong']) ? (int)$_POST['soLuong'] : 1;

            if ($soLuong < 1) $soLuong = 1;

            $sanPhamModel = new SanPhamModel();
            $sp = $sanPhamModel->layChiTietSanPham($productId);

            if (!$sp) {
                setFlash('error', 'Sản phẩm không tồn tại!');
                redirect(BASE_URL . '/index.php?controller=TrangChu');
            }

            if ($soLuong > $sp['SoLuongTon']) {
                setFlash('error', 'Rất tiếc, sản phẩm này chỉ còn ' . $sp['SoLuongTon'] . ' cái trong kho!');
                redirect(BASE_URL . '/index.php?controller=ChiTietSanPham&nId=' . $productId);
            }

            $gioHangModel = new GioHangModel();
            $gioHangModel->themVaoGioHang($_SESSION['User'], $productId, $soLuong);
            setFlash('success', 'Đã thêm sản phẩm vào giỏ hàng thành công!');
            redirect(BASE_URL . '/index.php?controller=GioHang');
        }
    }
}
