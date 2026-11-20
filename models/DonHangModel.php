<?php
require_once __DIR__ . '/../config/database.php';

class DonHangModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Thanh toán đơn hàng
    public function thanhToanDonHang($username, $hoten, $sdt, $diachi, $tongtien, $phuongthuc) {
        if (!$this->db) return false;
        try {
            $this->db->beginTransaction();

            // 1. Cập nhật thông tin mới nhất của User
            $sqlUpdateUser = "UPDATE NguoiDung SET HoTen = :hoten, SoDienThoai = :sdt, DiaChi = :diachi WHERE UserName = :user";
            $stmtUser = $this->db->prepare($sqlUpdateUser);
            $stmtUser->execute([
                ':hoten' => $hoten,
                ':sdt' => $sdt,
                ':diachi' => $diachi,
                ':user' => $username
            ]);

            // 2. Tạo đơn hàng mới trong bảng DonHang
            $sqlOrder = "INSERT INTO DonHang (UserName, NgayDat, TongTien, TrangThai, DiaChiGiaoHang, PhuongThucThanhToan)
                         VALUES (:user, NOW(), :tongtien, 0, :diachi, :phuongthuc)";
            $stmtOrder = $this->db->prepare($sqlOrder);
            $stmtOrder->execute([
                ':user' => $username,
                ':tongtien' => $tongtien,
                ':diachi' => $diachi,
                ':phuongthuc' => $phuongthuc
            ]);
            $orderId = $this->db->lastInsertId();

            // 3. Lấy sản phẩm từ giỏ hàng (ChiTietGioHang) đổ sang ChiTietDonHang
            $sqlCart = "SELECT ct.ProductID, ct.SoLuong, sp.Gia 
                        FROM GioHang gh 
                        INNER JOIN ChiTietGioHang ct ON gh.CartID = ct.CartID 
                        INNER JOIN SanPham sp ON ct.ProductID = sp.ProductID 
                        WHERE gh.UserName = :user";
            $stmtCart = $this->db->prepare($sqlCart);
            $stmtCart->execute([':user' => $username]);
            $cartItems = $stmtCart->fetchAll();

            $sqlDetail = "INSERT INTO ChiTietDonHang (OrderID, ProductID, SoLuong, GiaTaiThoiDiemMua)
                          VALUES (:orderId, :pid, :qty, :gia)";
            $stmtDetail = $this->db->prepare($sqlDetail);

            foreach ($cartItems as $item) {
                $stmtDetail->execute([
                    ':orderId' => $orderId,
                    ':pid' => $item['ProductID'],
                    ':qty' => $item['SoLuong'],
                    ':gia' => $item['Gia']
                ]);
            }

            // 4. Xóa sạch giỏ hàng của user
            $sqlEmpty = "DELETE ct FROM ChiTietGioHang ct 
                         INNER JOIN GioHang gh ON ct.CartID = gh.CartID 
                         WHERE gh.UserName = :user";
            $stmtEmpty = $this->db->prepare($sqlEmpty);
            $stmtEmpty->execute([':user' => $username]);

            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    // Lịch sử đơn hàng của 1 khách hàng
    public function layLichSuDonHang($username) {
        if (!$this->db) return [];
        $sql = "SELECT dh.*, dh.DiaChiGiaoHang AS DiaChi, dh.PhuongThucThanhToan AS PhuongThuc,
                       nd.HoTen, nd.SoDienThoai
                FROM DonHang dh
                LEFT JOIN NguoiDung nd ON dh.UserName = nd.UserName
                WHERE dh.UserName = :user 
                ORDER BY dh.OrderID DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user' => $username]);
        return $stmt->fetchAll();
    }

    // Lấy tất cả đơn hàng cho Admin
    public function layTatCaDonHang() {
        if (!$this->db) return [];
        $sql = "SELECT dh.*, dh.DiaChiGiaoHang AS DiaChi, dh.PhuongThucThanhToan AS PhuongThuc,
                       nd.HoTen, nd.SoDienThoai
                FROM DonHang dh
                LEFT JOIN NguoiDung nd ON dh.UserName = nd.UserName
                ORDER BY dh.OrderID DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Cập nhật trạng thái đơn (0: Chờ xử lý, 1: Đã xác nhận, 2: Đang giao, 3: Đã giao/hoàn tất)
    public function capNhatTrangThai($orderId, $trangThaiMoi) {
        if (!$this->db) return false;
        $sql = "UPDATE DonHang SET TrangThai = :trangthai WHERE OrderID = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':trangthai' => $trangThaiMoi,
            ':id' => $orderId
        ]);
    }

    // Lấy chi tiết đơn hàng
    public function layChiTietDonHang($orderId) {
        if (!$this->db) return [];
        $sql = "SELECT ct.*, ct.GiaTaiThoiDiemMua AS DonGia, 
                       (ct.SoLuong * ct.GiaTaiThoiDiemMua) AS ThanhTien,
                       sp.TenSanPham, sp.HinhAnh 
                FROM ChiTietDonHang ct
                INNER JOIN SanPham sp ON ct.ProductID = sp.ProductID
                WHERE ct.OrderID = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $orderId]);
        return $stmt->fetchAll();
    }

    public function layDonHangTheoId($orderId) {
        if (!$this->db) return null;
        $sql = "SELECT dh.*, dh.DiaChiGiaoHang AS DiaChi, dh.PhuongThucThanhToan AS PhuongThuc,
                       nd.HoTen, nd.SoDienThoai
                FROM DonHang dh
                LEFT JOIN NguoiDung nd ON dh.UserName = nd.UserName
                WHERE dh.OrderID = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $orderId]);
        return $stmt->fetch();
    }
}
