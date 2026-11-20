<?php
require_once __DIR__ . '/../../models/SanPhamModel.php';
require_once __DIR__ . '/../../models/DanhMucModel.php';
require_once __DIR__ . '/../../models/HangSanXuatModel.php';

class QuanLySanPhamController {

    // Hàm chuyển tiếng Việt không dấu
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
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);
        $str = preg_replace('/[^a-zA-Z0-9]/', '', $str);
        return $str;
    }

    // Xác định thư mục lưu ảnh theo danh mục (giống logic C# cũ)
    private function layThongTinThuMuc($catId, $tenDm = '') {
        switch ($catId) {
            case 1: return ['base' => 'img2/PC_vanphong/', 'prefix' => 'pc_vanphong'];
            case 2: return ['base' => 'img2/PC_gaming/', 'prefix' => 'pc_gaming'];
            case 3: return ['base' => 'Banphim/', 'prefix' => 'banphim'];
            case 4: return ['base' => 'Manhinh/', 'prefix' => 'manhinh'];
            case 5: return ['base' => 'Chuot/', 'prefix' => 'chuot'];
            default:
                $clean = !empty($tenDm) ? $this->chuyenTiengVietKhongDau($tenDm) : 'Khac';
                return ['base' => $clean . '/', 'prefix' => strtolower($clean)];
        }
    }

    // 1. Danh sách sản phẩm (NoiDung_HH.aspx)
    public function index() {
        $dmModel = new DanhMucModel();
        $spModel = new SanPhamModel();

        $dsDanhMuc = $dmModel->layTatCaDanhMuc();
        $selectedCatId = isset($_GET['id_dm']) ? (int)$_GET['id_dm'] : ($dsDanhMuc[0]['CategoryID'] ?? 1);
        $tuKhoa = trim($_GET['tuKhoa'] ?? '');

        if (!empty($tuKhoa)) {
            $dsSanPham = $spModel->timKiemTrongDanhMuc($tuKhoa, $selectedCatId);
        } else {
            $dsSanPham = $spModel->laySanPhamTheoDanhMuc($selectedCatId, 100, 0);
        }

        $pageTitle = "Quản Lý Hàng Hóa";
        require_once __DIR__ . '/../views/danh-sach-san-pham.php';
    }

    // 2. Thêm mới sản phẩm (Them.aspx)
    public function them() {
        $dmModel = new DanhMucModel();
        $hsxModel = new HangSanXuatModel();

        $dsDanhMuc = $dmModel->layTatCaDanhMuc();
        $dsHang = $hsxModel->layTatCaHang();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten = trim($_POST['tenSanPham'] ?? '');
            $dongia = (float)($_POST['donGia'] ?? 0);
            $slton = (int)($_POST['soLuongTon'] ?? 0);
            $iddm = (int)($_POST['idDanhMuc'] ?? 0);
            $idhangsx = (int)($_POST['idHang'] ?? 0);
            $mota = $_POST['moTa'] ?? '';
            $tskt = $_POST['thongSoKyThuat'] ?? '';

            if (empty($ten) || $iddm <= 0) {
                setFlash('error', 'Vui lòng nhập tên sản phẩm và chọn danh mục!');
                redirect(BASE_URL . '/admin/index.php?controller=QuanLySanPham&action=them');
            }

            // Nếu là PC (idhangsx = -1 hoặc 0)
            if ($idhangsx == -1) $idhangsx = 0;

            // Xử lý upload ảnh
            $anhRelPath = '';
            if (isset($_FILES['anh']) && $_FILES['anh']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['anh']['tmp_name'];
                $fileName = basename($_FILES['anh']['name']);
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $dmInfo = $dmModel->layChiTietDanhMuc($iddm);
                $infoFolder = $this->layThongTinThuMuc($iddm, $dmInfo['TenDanhMuc'] ?? '');

                $tempId = date('dmYHis');
                $subFolder = $infoFolder['prefix'] . '_new_' . $tempId . '/';
                $destDir = ROOT_PATH . '/' . $infoFolder['base'] . $subFolder;

                if (!is_dir($destDir)) {
                    mkdir($destDir, 0777, true);
                }

                $newFileName = pathinfo($fileName, PATHINFO_FILENAME) . '_new_' . $tempId . '.' . $ext;
                $destFile = $destDir . $newFileName;

                if (move_uploaded_file($fileTmp, $destFile)) {
                    $anhRelPath = $infoFolder['base'] . $subFolder . $newFileName;
                }
            }

            $spModel = new SanPhamModel();
            $spModel->themSanPham($ten, $dongia, $anhRelPath, $mota, $tskt, $slton, $idhangsx, $iddm);

            setFlash('success', 'Thêm mới sản phẩm thành công!');
            redirect(BASE_URL . '/admin/index.php?controller=QuanLySanPham&id_dm=' . $iddm);
        }

        $pageTitle = "Thêm Hàng Hóa Mới";
        require_once __DIR__ . '/../views/them-san-pham.php';
    }

    // 3. Chỉnh sửa sản phẩm (Sua.aspx)
    public function sua() {
        $id = isset($_GET['nId']) ? (int)$_GET['nId'] : 0;
        $spModel = new SanPhamModel();
        $dmModel = new DanhMucModel();
        $hsxModel = new HangSanXuatModel();

        $sp = $spModel->layChiTietSanPham($id);
        if (!$sp) {
            setFlash('error', 'Không tìm thấy sản phẩm!');
            redirect(BASE_URL . '/admin/index.php?controller=QuanLySanPham');
        }

        $dsDanhMuc = $dmModel->layTatCaDanhMuc();
        $dsHang = $hsxModel->layTatCaHang();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten = trim($_POST['tenSanPham'] ?? '');
            $dongia = (float)($_POST['donGia'] ?? 0);
            $slton = (int)($_POST['soLuongTon'] ?? 0);
            $newIdDm = (int)($_POST['idDanhMuc'] ?? 0);
            $idhangsx = (int)($_POST['idHang'] ?? 0);
            $mota = $_POST['moTa'] ?? '';
            $tskt = $_POST['thongSoKyThuat'] ?? '';

            if ($idhangsx == -1) $idhangsx = 0;

            $oldDbPath = $sp['HinhAnh'];
            $oldIdDm = (int)$sp['CategoryID'];
            $anhToSave = $oldDbPath;

            $dmInfo = $dmModel->layChiTietDanhMuc($newIdDm);
            $infoNew = $this->layThongTinThuMuc($newIdDm, $dmInfo['TenDanhMuc'] ?? '');

            // TH1: Người dùng tải ảnh MỚI
            if (isset($_FILES['anh']) && $_FILES['anh']['error'] === UPLOAD_ERR_OK) {
                // Xóa ảnh và folder cũ nếu có
                if (!empty($oldDbPath) && file_exists(ROOT_PATH . '/' . $oldDbPath)) {
                    unlink(ROOT_PATH . '/' . $oldDbPath);
                    $oldDir = dirname(ROOT_PATH . '/' . $oldDbPath);
                    if (is_dir($oldDir) && count(scandir($oldDir)) == 2) rmdir($oldDir);
                }

                $fileTmp = $_FILES['anh']['tmp_name'];
                $fileName = basename($_FILES['anh']['name']);
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $subFolder = $infoNew['prefix'] . '_' . $id . '/';
                $physicalDir = ROOT_PATH . '/' . $infoNew['base'] . $subFolder;
                if (!is_dir($physicalDir)) mkdir($physicalDir, 0777, true);

                $strdt = date('dmYHis');
                $newFileName = $infoNew['prefix'] . '_' . $id . '_' . $strdt . '.' . $ext;
                $destFile = $physicalDir . $newFileName;

                if (move_uploaded_file($fileTmp, $destFile)) {
                    $anhToSave = $infoNew['base'] . $subFolder . $newFileName;
                }
            }
            // TH2: Giữ ảnh cũ nhưng ĐỔI DANH MỤC (di chuyển thư mục vật lý như code C#)
            elseif ($oldIdDm !== $newIdDm && !empty($oldDbPath)) {
                $oldPhysical = ROOT_PATH . '/' . $oldDbPath;
                if (file_exists($oldPhysical)) {
                    $subFolder = $infoNew['prefix'] . '_' . $id . '/';
                    $newPhysicalDir = ROOT_PATH . '/' . $infoNew['base'] . $subFolder;
                    if (!is_dir($newPhysicalDir)) mkdir($newPhysicalDir, 0777, true);

                    $ext = pathinfo($oldPhysical, PATHINFO_EXTENSION);
                    $newFileName = $infoNew['prefix'] . '_' . $id . '_' . date('dmY') . '_moved.' . $ext;
                    $newPhysicalFile = $newPhysicalDir . $newFileName;

                    if (rename($oldPhysical, $newPhysicalFile)) {
                        $anhToSave = $infoNew['base'] . $subFolder . $newFileName;
                        $oldDir = dirname($oldPhysical);
                        if (is_dir($oldDir) && count(scandir($oldDir)) == 2) rmdir($oldDir);
                    }
                }
            }

            $spModel->suaSanPham($id, $ten, $dongia, $anhToSave, $mota, $tskt, $slton, $idhangsx, $newIdDm);
            setFlash('success', 'Cập nhật thông tin sản phẩm thành công!');
            redirect(BASE_URL . '/admin/index.php?controller=QuanLySanPham&id_dm=' . $newIdDm);
        }

        $pageTitle = "Chỉnh Sửa Hàng Hóa #" . $id;
        require_once __DIR__ . '/../views/sua-san-pham.php';
    }

    // 4. Xóa sản phẩm và dọn dẹp thư mục ảnh vật lý đệ quy
    public function xoa() {
        $id = isset($_GET['nId']) ? (int)$_GET['nId'] : 0;
        $idDm = isset($_GET['id_dm']) ? (int)$_GET['id_dm'] : 1;

        $spModel = new SanPhamModel();
        $sp = $spModel->layChiTietSanPham($id);

        if ($sp) {
            // Xóa file và thư mục ảnh vật lý
            if (!empty($sp['HinhAnh'])) {
                $fullPath = ROOT_PATH . '/' . $sp['HinhAnh'];
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                    $folderPath = dirname($fullPath);
                    if (is_dir($folderPath)) {
                        // Xóa các file còn lại trong folder nếu có
                        $files = glob($folderPath . '/*');
                        foreach ($files as $file) { if (is_file($file)) unlink($file); }
                        rmdir($folderPath);
                    }
                }
            }

            $spModel->xoaSanPham($id);
            setFlash('success', 'Đã xóa sản phẩm thành công!');
        }
        redirect(BASE_URL . '/admin/index.php?controller=QuanLySanPham&id_dm=' . $idDm);
    }
}
