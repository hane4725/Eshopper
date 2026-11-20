<?php
require_once __DIR__ . '/../config/database.php';

class HangSanXuatModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // sp_DS_HANG: Lấy danh sách toàn bộ hãng sản xuất
    public function layTatCaHang() {
        if (!$this->db) return [];
        $sql = "SELECT * FROM hangsanxuat ORDER BY BrandID ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // sp_CHITIET_HANG: Lấy chi tiết hãng
    public function layChiTietHang($id) {
        if (!$this->db) return null;
        $sql = "SELECT * FROM hangsanxuat WHERE BrandID = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // sp_INSERT_HANG: Thêm hãng sản xuất
    public function themHang($tenHang) {
        if (!$this->db) return false;
        $sql = "INSERT INTO hangsanxuat (TenHang) VALUES (:tenHang)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':tenHang' => $tenHang]);
    }

    // sp_UPDATE_HANG: Cập nhật hãng sản xuất
    public function suaHang($id, $tenHang) {
        if (!$this->db) return false;
        $sql = "UPDATE hangsanxuat SET TenHang = :tenHang WHERE BrandID = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':tenHang' => $tenHang
        ]);
    }

    // sp_DELETE_HANG: Xóa hãng sản xuất
    public function xoaHang($id) {
        if (!$this->db) return false;
        $sql = "DELETE FROM hangsanxuat WHERE BrandID = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
