<?php
require_once __DIR__ . '/../config/database.php';

class DanhMucModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // sp_DS_DM: Lấy tất cả danh mục
    public function layTatCaDanhMuc() {
        if (!$this->db) return [];
        $sql = "SELECT * FROM danhmuc ORDER BY CategoryID ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // sp_DS_DM_THEOID: Lấy chi tiết danh mục theo ID
    public function layChiTietDanhMuc($id) {
        if (!$this->db) return null;
        $sql = "SELECT * FROM danhmuc WHERE CategoryID = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // sp_INSERT_DM: Thêm danh mục mới
    public function themDanhMuc($tenDanhMuc, $anhDm) {
        if (!$this->db) return false;
        $sql = "INSERT INTO danhmuc (TenDanhMuc, AnhDM) VALUES (:ten, :anh)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':ten' => $tenDanhMuc,
            ':anh' => $anhDm
        ]);
    }

    // sp_UPDATE_DM: Cập nhật danh mục
    public function suaDanhMuc($id, $tenDanhMuc, $anhDm) {
        if (!$this->db) return false;
        $sql = "UPDATE danhmuc SET TenDanhMuc = :ten, AnhDM = :anh WHERE CategoryID = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':ten' => $tenDanhMuc,
            ':anh' => $anhDm
        ]);
    }

    // sp_DELETE_DM: Xóa danh mục
    public function xoaDanhMuc($id) {
        if (!$this->db) return false;
        $sql = "DELETE FROM danhmuc WHERE CategoryID = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
