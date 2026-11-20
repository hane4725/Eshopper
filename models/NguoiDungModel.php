<?php
require_once __DIR__ . '/../config/database.php';

class NguoiDungModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // sp_LIST_MEMBER_N: Đăng nhập
    public function kiemTraDangNhap($username, $matKhauMD5) {
        if (!$this->db) return null;
        $sql = "SELECT *, UserName AS Username FROM nguoidung WHERE UserName = :user AND Matkhau = :pass LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':user' => $username,
            ':pass' => $matKhauMD5
        ]);
        return $stmt->fetch();
    }

    // sp_DKY_TAI_KHOAN: Đăng ký tài khoản mới
    public function dangKyTaiKhoan($username, $matKhauMD5, $hoTen, $sdt, $email, $diaChi) {
        if (!$this->db) return false;
        // Kiểm tra xem username đã tồn tại chưa
        $sqlCheck = "SELECT COUNT(*) FROM nguoidung WHERE Username = :user";
        $stmtCheck = $this->db->prepare($sqlCheck);
        $stmtCheck->execute([':user' => $username]);
        if ($stmtCheck->fetchColumn() > 0) {
            throw new Exception("Tên đăng nhập này đã có người sử dụng.");
        }

        $sql = "INSERT INTO nguoidung (Username, Matkhau, HoTen, SoDienThoai, Email, DiaChi, Quyen)
                VALUES (:user, :pass, :hoten, :sdt, :email, :diachi, 1)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user' => $username,
            ':pass' => $matKhauMD5,
            ':hoten' => $hoTen,
            ':sdt' => $sdt,
            ':email' => $email,
            ':diachi' => $diaChi
        ]);
    }

    // sp_LayThongTinUser: Lấy thông tin người dùng
    public function layThongTinUser($username) {
        if (!$this->db) return null;
        $sql = "SELECT *, UserName AS Username FROM nguoidung WHERE UserName = :user LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user' => $username]);
        return $stmt->fetch();
    }

    // sp_Admin_LayDanhSachUser: Danh sách toàn bộ người dùng
    public function layTatCaNguoiDung() {
        if (!$this->db) return [];
        $sql = "SELECT *, UserName AS Username FROM nguoidung ORDER BY Quyen ASC, UserName ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // sp_Admin_CapNhatQuyen: Đổi quyền (0, 1, 2)
    public function capNhatQuyen($username, $quyenMoi) {
        if (!$this->db) return false;
        $sql = "UPDATE nguoidung SET Quyen = :quyen WHERE Username = :user";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':quyen' => $quyenMoi,
            ':user' => $username
        ]);
    }

    // sp_Admin_XoaUser: Xóa tài khoản
    public function xoaNguoiDung($username) {
        if (!$this->db) return false;
        $sql = "DELETE FROM nguoidung WHERE Username = :user";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':user' => $username]);
    }
}
