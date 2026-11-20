<?php
require_once __DIR__ . '/../../models/DanhMucModel.php';

class QuanLyDanhMucController {

    private function chuyenTiengVietKhongDau($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);
        $str = preg_replace('/[^a-zA-Z0-9]/', '', $str);
        return $str;
    }

    public function index() {
        $dmModel = new DanhMucModel();
        $dsDanhMuc = $dmModel->layTatCaDanhMuc();
        $pageTitle = "Quản Lý Danh Mục";
        require_once __DIR__ . '/../views/danh-sach-danh-muc.php';
    }

    public function them() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenDm = trim($_POST['tenDanhMuc'] ?? '');
            if (empty($tenDm)) {
                setFlash('error', 'Tên danh mục không được để trống!');
                redirect(BASE_URL . '/admin/index.php?controller=QuanLyDanhMuc&action=them');
            }

            // Tự động tạo thư mục rỗng cho danh mục mới (như code C#)
            $folderName = $this->chuyenTiengVietKhongDau($tenDm);
            $productFolderPath = ROOT_PATH . '/' . $folderName;
            if (!is_dir($productFolderPath)) {
                mkdir($productFolderPath, 0777, true);
            }

            // Upload banner vào Banner/
            $anhRelPath = '';
            if (isset($_FILES['anh']) && $_FILES['anh']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['anh']['tmp_name'];
                $fileName = basename($_FILES['anh']['name']);
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $bannerDir = ROOT_PATH . '/Banner/';
                if (!is_dir($bannerDir)) mkdir($bannerDir, 0777, true);

                $strdt = date('dmYHis');
                $newFileName = pathinfo($fileName, PATHINFO_FILENAME) . '_' . $strdt . '.' . $ext;
                $destFile = $bannerDir . $newFileName;

                if (move_uploaded_file($fileTmp, $destFile)) {
                    $anhRelPath = 'Banner/' . $newFileName;
                }
            }

            $dmModel = new DanhMucModel();
            $dmModel->themDanhMuc($tenDm, $anhRelPath);
            setFlash('success', 'Thêm mới danh mục thành công!');
            redirect(BASE_URL . '/admin/index.php?controller=QuanLyDanhMuc');
        }

        $pageTitle = "Thêm Danh Mục Mới";
        require_once __DIR__ . '/../views/them-danh-muc.php';
    }

    public function sua() {
        $id = isset($_GET['nId']) ? (int)$_GET['nId'] : 0;
        $dmModel = new DanhMucModel();
        $dm = $dmModel->layChiTietDanhMuc($id);

        if (!$dm) {
            setFlash('error', 'Không tìm thấy danh mục!');
            redirect(BASE_URL . '/admin/index.php?controller=QuanLyDanhMuc');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenDm = trim($_POST['tenDanhMuc'] ?? '');
            $anhRelPath = $dm['AnhDM'];

            if (empty($tenDm)) {
                setFlash('error', 'Tên danh mục không được để trống!');
                redirect(BASE_URL . '/admin/index.php?controller=QuanLyDanhMuc&action=sua&nId=' . $id);
            }

            if (isset($_FILES['anh']) && $_FILES['anh']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['anh']['tmp_name'];
                $fileName = basename($_FILES['anh']['name']);
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $bannerDir = ROOT_PATH . '/Banner/';
                if (!is_dir($bannerDir)) mkdir($bannerDir, 0777, true);

                $strdt = date('dmYHis');
                $newFileName = pathinfo($fileName, PATHINFO_FILENAME) . '_' . $strdt . '.' . $ext;
                $destFile = $bannerDir . $newFileName;

                if (move_uploaded_file($fileTmp, $destFile)) {
                    // Xóa banner cũ
                    if (!empty($dm['AnhDM']) && file_exists(ROOT_PATH . '/' . $dm['AnhDM'])) {
                        unlink(ROOT_PATH . '/' . $dm['AnhDM']);
                    }
                    $anhRelPath = 'Banner/' . $newFileName;
                }
            }

            $dmModel->suaDanhMuc($id, $tenDm, $anhRelPath);
            setFlash('success', 'Cập nhật danh mục thành công!');
            redirect(BASE_URL . '/admin/index.php?controller=QuanLyDanhMuc');
        }

        $pageTitle = "Chỉnh Sửa Danh Mục #" . $id;
        require_once __DIR__ . '/../views/sua-danh-muc.php';
    }

    public function xoa() {
        $id = isset($_GET['nId']) ? (int)$_GET['nId'] : 0;
        $dmModel = new DanhMucModel();
        $dm = $dmModel->layChiTietDanhMuc($id);

        if ($dm) {
            // Xóa file banner
            if (!empty($dm['AnhDM']) && file_exists(ROOT_PATH . '/' . $dm['AnhDM'])) {
                unlink(ROOT_PATH . '/' . $dm['AnhDM']);
            }

            // Xóa thư mục sản phẩm tương ứng nếu rỗng hoặc theo logic cũ
            $folderName = $this->chuyenTiengVietKhongDau($dm['TenDanhMuc']);
            $folderPath = ROOT_PATH . '/' . $folderName;
            if (is_dir($folderPath)) {
                $files = glob($folderPath . '/*');
                foreach ($files as $file) { if (is_file($file)) unlink($file); }
                rmdir($folderPath);
            }

            $dmModel->xoaDanhMuc($id);
            setFlash('success', 'Đã xóa danh mục thành công!');
        }
        redirect(BASE_URL . '/admin/index.php?controller=QuanLyDanhMuc');
    }
}
