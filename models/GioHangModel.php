<?php
require_once __DIR__ . '/../config/database.php';

class GioHangModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Lấy hoặc tạo mới CartID cho User
    private function layOrCreateCartId($username) {
        if (!$this->db) return 0;
        // Kiểm tra xem User đã có bản ghi trong bảng GioHang chưa
        $sql = "SELECT CartID FROM GioHang WHERE UserName = :user LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user' => $username]);
        $cartId = $stmt->fetchColumn();

        if (!$cartId) {
            $sqlInsert = "INSERT INTO GioHang (UserName) VALUES (:user)";
            $stmtInsert = $this->db->prepare($sqlInsert);
            $stmtInsert->execute([':user' => $username]);
            $cartId = $this->db->lastInsertId();
        }
        return (int)$cartId;
    }

    // Thêm sản phẩm vào giỏ
    public function themVaoGioHang($username, $productId, $soLuong = 1) {
        if (!$this->db) return false;
        $cartId = $this->layOrCreateCartId($username);

        // Kiểm tra xem ProductID đã có trong ChiTietGioHang chưa
        $sqlCheck = "SELECT CartItemID, SoLuong FROM ChiTietGioHang WHERE CartID = :cartId AND ProductID = :pid LIMIT 1";
        $stmtCheck = $this->db->prepare($sqlCheck);
        $stmtCheck->execute([':cartId' => $cartId, ':pid' => $productId]);
        $existing = $stmtCheck->fetch();

        if ($existing) {
            $sqlUpdate = "UPDATE ChiTietGioHang SET SoLuong = SoLuong + :qty WHERE CartItemID = :id";
            $stmtUpdate = $this->db->prepare($sqlUpdate);
            return $stmtUpdate->execute([
                ':qty' => $soLuong,
                ':id' => $existing['CartItemID']
            ]);
        } else {
            $sqlInsert = "INSERT INTO ChiTietGioHang (CartID, ProductID, SoLuong) VALUES (:cartId, :pid, :qty)";
            $stmtInsert = $this->db->prepare($sqlInsert);
            return $stmtInsert->execute([
                ':cartId' => $cartId,
                ':pid' => $productId,
                ':qty' => $soLuong
            ]);
        }
    }

    // Lấy giỏ hàng của user
    public function layGioHang($username) {
        if (!$this->db) return [];
        $sql = "SELECT ct.CartItemID, ct.CartID, ct.ProductID, ct.SoLuong,
                       sp.TenSanPham, sp.Gia, sp.HinhAnh, sp.SoLuongTon,
                       (sp.Gia * ct.SoLuong) AS ThanhTien
                FROM GioHang gh
                INNER JOIN ChiTietGioHang ct ON gh.CartID = ct.CartID
                INNER JOIN SanPham sp ON ct.ProductID = sp.ProductID
                WHERE gh.UserName = :user
                ORDER BY ct.CartItemID DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user' => $username]);
        return $stmt->fetchAll();
    }

    // Cập nhật số lượng
    public function capNhatSoLuong($username, $productId, $soLuongMoi) {
        if (!$this->db) return false;
        if ($soLuongMoi <= 0) {
            return $this->xoaKhoiGioHang($username, $productId);
        }

        $cartId = $this->layOrCreateCartId($username);
        $sql = "UPDATE ChiTietGioHang SET SoLuong = :qty WHERE CartID = :cartId AND ProductID = :pid";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':qty' => $soLuongMoi,
            ':cartId' => $cartId,
            ':pid' => $productId
        ]);
    }

    // Xóa món hàng
    public function xoaKhoiGioHang($username, $productId) {
        if (!$this->db) return false;
        $cartId = $this->layOrCreateCartId($username);
        $sql = "DELETE FROM ChiTietGioHang WHERE CartID = :cartId AND ProductID = :pid";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':cartId' => $cartId,
            ':pid' => $productId
        ]);
    }

    // Xóa sạch giỏ hàng khi đặt hàng xong
    public function xoaSachGioHang($username) {
        if (!$this->db) return false;
        $cartId = $this->layOrCreateCartId($username);
        $sql = "DELETE FROM ChiTietGioHang WHERE CartID = :cartId";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':cartId' => $cartId]);
    }
}
