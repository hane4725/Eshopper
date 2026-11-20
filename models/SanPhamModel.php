<?php
require_once __DIR__ . '/../config/database.php';

class SanPhamModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // sp_DS_8SP_TRANGCHU: 8 sản phẩm phổ biến
    public function lay8SanPhamTrangChu() {
        if (!$this->db) return [];
        $sql = "SELECT sp.*, dm.TenDanhMuc, hsx.TenHang 
                FROM sanpham sp
                LEFT JOIN danhmuc dm ON sp.CategoryID = dm.CategoryID
                LEFT JOIN hangsanxuat hsx ON sp.BrandID = hsx.BrandID
                ORDER BY sp.ProductID DESC LIMIT 8";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // sp_DS_NEW8SP_TRANGCHU: 8 sản phẩm mới cập nhật
    public function lay8SanPhamMoiNhat() {
        if (!$this->db) return [];
        $sql = "SELECT sp.*, dm.TenDanhMuc, hsx.TenHang 
                FROM sanpham sp
                LEFT JOIN danhmuc dm ON sp.CategoryID = dm.CategoryID
                LEFT JOIN hangsanxuat hsx ON sp.BrandID = hsx.BrandID
                ORDER BY sp.ProductID ASC LIMIT 8";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // sp_DS_SP_ALL: Toàn bộ sản phẩm
    public function layTatCaSanPham() {
        if (!$this->db) return [];
        $sql = "SELECT sp.*, dm.TenDanhMuc, hsx.TenHang 
                FROM sanpham sp
                LEFT JOIN danhmuc dm ON sp.CategoryID = dm.CategoryID
                LEFT JOIN hangsanxuat hsx ON sp.BrandID = hsx.BrandID
                ORDER BY sp.ProductID DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // sp_CHITIET_SANPHAM_ALL: Chi tiết 1 sản phẩm
    public function layChiTietSanPham($id) {
        if (!$this->db) return null;
        $sql = "SELECT sp.*, dm.TenDanhMuc, hsx.TenHang 
                FROM sanpham sp
                LEFT JOIN danhmuc dm ON sp.CategoryID = dm.CategoryID
                LEFT JOIN hangsanxuat hsx ON sp.BrandID = hsx.BrandID
                WHERE sp.ProductID = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // sp_DS_SANPHAM_THEODM: Lấy sản phẩm theo danh mục (có phân trang)
    public function laySanPhamTheoDanhMuc($categoryId, $limit = 12, $offset = 0) {
        if (!$this->db) return [];
        $sql = "SELECT sp.*, dm.TenDanhMuc, hsx.TenHang 
                FROM sanpham sp
                LEFT JOIN danhmuc dm ON sp.CategoryID = dm.CategoryID
                LEFT JOIN hangsanxuat hsx ON sp.BrandID = hsx.BrandID
                WHERE sp.CategoryID = :catId
                ORDER BY sp.ProductID DESC 
                LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':catId', (int)$categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function demSanPhamTheoDanhMuc($categoryId) {
        if (!$this->db) return 0;
        $sql = "SELECT COUNT(*) FROM sanpham WHERE CategoryID = :catId";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':catId' => $categoryId]);
        return (int)$stmt->fetchColumn();
    }

    // sp_DS_SP_LOCGIA_GEAR: Lọc sản phẩm theo danh mục, khoảng giá và hãng
    public function locSanPham($categoryId, $minPrice = 0, $maxPrice = 999999999, $brandId = 0, $limit = 12, $offset = 0) {
        if (!$this->db) return [];
        $sql = "SELECT sp.*, dm.TenDanhMuc, hsx.TenHang 
                FROM sanpham sp
                LEFT JOIN danhmuc dm ON sp.CategoryID = dm.CategoryID
                LEFT JOIN hangsanxuat hsx ON sp.BrandID = hsx.BrandID
                WHERE sp.CategoryID = :catId 
                  AND sp.Gia >= :minPrice 
                  AND sp.Gia <= :maxPrice";

        if ($brandId > 0) {
            $sql .= " AND sp.BrandID = :brandId";
        }

        $sql .= " ORDER BY sp.ProductID DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':catId', (int)$categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':minPrice', (float)$minPrice);
        $stmt->bindValue(':maxPrice', (float)$maxPrice);
        if ($brandId > 0) {
            $stmt->bindValue(':brandId', (int)$brandId, PDO::PARAM_INT);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function demLocSanPham($categoryId, $minPrice = 0, $maxPrice = 999999999, $brandId = 0) {
        if (!$this->db) return 0;
        $sql = "SELECT COUNT(*) FROM sanpham WHERE CategoryID = :catId AND Gia >= :minPrice AND Gia <= :maxPrice";
        if ($brandId > 0) {
            $sql .= " AND BrandID = :brandId";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':catId', (int)$categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':minPrice', (float)$minPrice);
        $stmt->bindValue(':maxPrice', (float)$maxPrice);
        if ($brandId > 0) {
            $stmt->bindValue(':brandId', (int)$brandId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    // sp_SEARCH_ALL: Tìm kiếm toàn site
    public function timKiemToanSite($tuKhoa, $limit = 12, $offset = 0) {
        if (!$this->db) return [];
        $sql = "SELECT sp.*, dm.TenDanhMuc, hsx.TenHang 
                FROM sanpham sp
                LEFT JOIN danhmuc dm ON sp.CategoryID = dm.CategoryID
                LEFT JOIN hangsanxuat hsx ON sp.BrandID = hsx.BrandID
                WHERE sp.TenSanPham LIKE :kw
                ORDER BY sp.ProductID DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':kw', '%' . $tuKhoa . '%');
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function demTimKiemToanSite($tuKhoa) {
        if (!$this->db) return 0;
        $sql = "SELECT COUNT(*) FROM sanpham WHERE TenSanPham LIKE :kw";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':kw' => '%' . $tuKhoa . '%']);
        return (int)$stmt->fetchColumn();
    }

    // sp_DS_SEARCH: Tìm kiếm trong 1 danh mục (dùng cho Admin)
    public function timKiemTrongDanhMuc($tuKhoa, $categoryId) {
        if (!$this->db) return [];
        $sql = "SELECT sp.*, dm.TenDanhMuc, hsx.TenHang 
                FROM sanpham sp
                LEFT JOIN danhmuc dm ON sp.CategoryID = dm.CategoryID
                LEFT JOIN hangsanxuat hsx ON sp.BrandID = hsx.BrandID
                WHERE sp.CategoryID = :catId AND sp.TenSanPham LIKE :kw
                ORDER BY sp.ProductID DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':catId' => $categoryId,
            ':kw' => '%' . $tuKhoa . '%'
        ]);
        return $stmt->fetchAll();
    }

    // sp_INSERT_SP: Thêm sản phẩm mới
    public function themSanPham($ten, $dongia, $anh, $mota, $tskt, $slton, $idhangsx, $iddm) {
        if (!$this->db) return false;
        $sql = "INSERT INTO sanpham (TenSanPham, Gia, HinhAnh, MoTa, ThongSoKyThuat, SoLuongTon, BrandID, CategoryID)
                VALUES (:ten, :dongia, :anh, :mota, :tskt, :slton, :idhangsx, :iddm)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':ten' => $ten,
            ':dongia' => $dongia,
            ':anh' => $anh,
            ':mota' => $mota,
            ':tskt' => $tskt,
            ':slton' => $slton,
            ':idhangsx' => $idhangsx,
            ':iddm' => $iddm
        ]);
    }

    // sp_UPDATE_SP: Cập nhật sản phẩm
    public function suaSanPham($id, $ten, $dongia, $anh, $mota, $tskt, $slton, $idhangsx, $iddm) {
        if (!$this->db) return false;
        $sql = "UPDATE sanpham SET 
                    TenSanPham = :ten,
                    Gia = :dongia,
                    HinhAnh = :anh,
                    MoTa = :mota,
                    ThongSoKyThuat = :tskt,
                    SoLuongTon = :slton,
                    BrandID = :idhangsx,
                    CategoryID = :iddm
                WHERE ProductID = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':ten' => $ten,
            ':dongia' => $dongia,
            ':anh' => $anh,
            ':mota' => $mota,
            ':tskt' => $tskt,
            ':slton' => $slton,
            ':idhangsx' => $idhangsx,
            ':iddm' => $iddm
        ]);
    }

    // sp_DELETE_SP: Xóa sản phẩm
    public function xoaSanPham($id) {
        if (!$this->db) return false;
        $sql = "DELETE FROM sanpham WHERE ProductID = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
