CREATE TABLE NhanVien (
    MaNV INT PRIMARY KEY AUTO_INCREMENT,
    HoTen VARCHAR(100) NOT NULL,
    NgaySinh DATE NOT NULL,
    CanCuocCongDan VARCHAR(12) UNIQUE NOT NULL,
    GioiTinh CHAR(1),
    CHECK (GioiTinh IN ('M', 'F')),
    SoDienThoai VARCHAR(15) NOT NULL,
    SoNha VARCHAR(255),
    Duong VARCHAR(255),
    Xa VARCHAR(255) NOT NULL,
    Huyen VARCHAR(255) NOT NULL,
    Tinh VARCHAR(255) NOT NULL,
    MaPB INT,
    -- LoaiNV VARCHAR(20),
    CHECK (LoaiNV IN ('Toan thoi gian', 'Ban thoi gian')),
    -- ChucNang VARCHAR(255)
);

CREATE TABLE NhanVienBanThoiGian (
    MaNV INT PRIMARY KEY,
    LuongTheoGio DECIMAL(10, 2),
    CONSTRAINT FK_NhanVien_BanThoiGian FOREIGN KEY (MaNV)
        REFERENCES NhanVien(MaNV) ON DELETE CASCADE
);

CREATE TABLE CaLam (
    MaCa INT PRIMARY KEY AUTO_INCREMENT,
    Nam INT NOT NULL,
    Tuan INT NOT NULL,
    Thu INT NOT NULL,
    Ca VARCHAR(50) NOT NULL,
);

CREATE TABLE ChiaTheo (
    MaNV INT,
    MaCa INT,
    ThoiGianDangKy TIMESTAMP,
    PRIMARY KEY (MaNV, MaCa),
    CONSTRAINT FK_ChiaTheo_NhanVien FOREIGN KEY (MaNV)
        REFERENCES NhanVienBanThoiGian(MaNV) ON DELETE CASCADE,
    CONSTRAINT FK_ChiaTheo_CaLam FOREIGN KEY (MaCa)
        REFERENCES CaLam(MaCa) ON DELETE CASCADE
);


CREATE TABLE NhanVienToanThoiGian (
    MaNV INT PRIMARY KEY,
    LuongCoBan DECIMAL(10, 2),
    CONSTRAINT FK_NhanVien_ToanThoiGian FOREIGN KEY (MaNV)
        REFERENCES NhanVien(MaNV) ON DELETE CASCADE
);

ALTER TABLE CaLam
ADD CONSTRAINT FK_CaLamViec_NhanVien FOREIGN KEY (MaNV)
    REFERENCES NhanVienBanThoiGian(MaNV) ON DELETE CASCADE;

CREATE TABLE NhanVienToanThoiGian (
    MaNV INT PRIMARY KEY,
    LuongCoBan DECIMAL(10, 2),
    CONSTRAINT FK_NhanVien_ToanThoiGian FOREIGN KEY (MaNV)
        REFERENCES NhanVien(MaNV) ON DELETE CASCADE
);

CREATE TABLE PhongBan (
    MaPB INT PRIMARY KEY AUTO_INCREMENT,
    TenPB VARCHAR(100) UNIQUE NOT NULL,
    -- MaNVQuanLy INT,
    MaPBQuanLy INT
);

CREATE TABLE QuanLy (
    MaPB INT,
    MaNV INT UNIQUE,
    NgayBatDau DATE,
    CONSTRAINT PK_QuanLy PRIMARY KEY (MaPB, MaNV)
);

-- Các alter để ko bị lỗi vòng tròn
-- ALTER TABLE NhanVien
-- ADD CONSTRAINT FK_QuanLy FOREIGN KEY (MaQL)
--    REFERENCES NhanVien(MaNV) ON DELETE SET NULL;

ALTER TABLE PhongBan
ADD CONSTRAINT FK_PB_QL FOREIGN KEY (MaNVQuanLy)
    REFERENCES NhanVien(MaNV);

ALTER TABLE PhongBan
ADD CONSTRAINT FK_PB_PB FOREIGN KEY (MaPBQuanLy)
    REFERENCES PhongBan(MaPB);

ALTER TABLE QuanLy
ADD CONSTRAINT FK_QuanLy_PhongBan FOREIGN KEY (MaPB) 
    REFERENCES PhongBan(MaPB);

ALTER TABLE QuanLy
ADD CONSTRAINT FK_QuanLy_NhanVien FOREIGN KEY (MaNV) 
    REFERENCES NhanVien(MaNV);

CREATE TABLE NhanVienKiemKho (
    MaNV INT PRIMARY KEY,
    CONSTRAINT FK_NhanVien_KiemKho FOREIGN KEY (MaNV)
        REFERENCES NhanVien(MaNV) ON DELETE CASCADE
);

CREATE TABLE NhanVienBep (
    MaNV INT PRIMARY KEY,
    ChuyenMon VARCHAR(100),
    ThoiGianDaoTao DECIMAL(10, 2),
    ChungChiHanhNghe VARCHAR(100),
    CONSTRAINT FK_NhanVien_Bep FOREIGN KEY (MaNV)
        REFERENCES NhanVien(MaNV) ON DELETE CASCADE
);

CREATE TABLE PhucVu (
    MaNV INT PRIMARY KEY,
    ViTri VARCHAR(100),
    CONSTRAINT FK_NhanVien_PhucVu FOREIGN KEY (MaNV)
        REFERENCES NhanVien(MaNV) ON DELETE CASCADE
);

CREATE TABLE NguyenLieu (
    MaNL INT PRIMARY KEY AUTO_INCREMENT,
    TenNguyenLieu VARCHAR(100) NOT NULL,
    DonViTinh VARCHAR(50),
    LoSanXuat VARCHAR(50),
    SoLuongTrongKho INT CHECK (SoLuongTrongKho >= 0)
);

CREATE TABLE NhaCungCap (
    -- MaNCC INT PRIMARY KEY AUTO_INCREMENT,
    TenNCC VARCHAR(100) NOT NULL,
    SoNha VARCHAR(50) NOT NULL,
    TenDuong VARCHAR(100) NOT NULL,
    PhuongXa VARCHAR(100) NOT NULL,
    QuanHuyen VARCHAR(100) NOT NULL,
    TinhThanh VARCHAR(100) NOT NULL,
    -- ThongTinLienLac VARCHAR(100),
    -- QuyTrinhKiemTra TEXT
);

CREATE TABLE NCC_SDT (
    TenNCC VARCHAR(100) NOT NULL,
    SDT VARCHAR(15) NOT NULL,  -- Điều chỉnh kích thước phù hợp với định dạng số điện thoại
    PRIMARY KEY (TenNCC, SDT)  -- Có thể sử dụng cả hai trường làm khóa chính nếu cần
);

CREATE TABLE NCC_email (
    TenNCC VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,  -- Điều chỉnh kích thước cho phù hợp với định dạng email
    PRIMARY KEY (TenNCC, Email)   -- Khóa chính có thể là sự kết hợp của cả hai trường
);

CREATE TABLE CungCap (
    MaNL INT,
    TenNCC VARCHAR(100),
    MaNVKiemKho INT,
    SoLuongGiao INT CHECK (SoLuongGiao >= 0),
    SoLuongNhapKho INT CHECK (SoLuongNhapKho >= 0),
    ThoiGian DATETIME NOT NULL,
    LyDoSaiLech TEXT,
    PRIMARY KEY (TenNCC, MaNL),
    CONSTRAINT FK_CungCap_NguyenLieu FOREIGN KEY (MaNL)
        REFERENCES NguyenLieu(MaNL) ON DELETE CASCADE,
    CONSTRAINT FK_CungCap_NhaCungCap FOREIGN KEY (TenNCC)
        REFERENCES NhaCungCap(TenNCC) ON DELETE CASCADE,
    CONSTRAINT FK_CungCap_NhanVienKiemKho FOREIGN KEY (MaNVKiemKho)
        REFERENCES NhanVienKiemKho(MaNV) ON DELETE CASCADE
);

CREATE TABLE KhachHang (
    MaKH INT PRIMARY KEY AUTO_INCREMENT,
    HoTen VARCHAR(100) NOT NULL,
    GioiTinh CHAR(1),
    CHECK (GioiTinh IN ('M', 'F')),
    SoDienThoai VARCHAR(15) NOT NULL,
    SoNha VARCHAR(50) NOT NULL,         
    TenDuong VARCHAR(100) NOT NULL,     
    PhuongXa VARCHAR(100) NOT NULL,     
    QuanHuyen VARCHAR(100) NOT NULL,     
    TinhThanh VARCHAR(100) NOT NULL,    
    LoaiKH VARCHAR(20),
    CHECK (LoaiKH IN ('Ca nhan', 'Ung dung')),
    NgaySinh DATE,                     
    CCCD VARCHAR(12) NOT NULL          
);


CREATE TABLE DonHang (
    MaDH INT PRIMARY KEY AUTO_INCREMENT,
    ThoiGianTao DATETIME NOT NULL,
    SoLuongMonHoanTat INT CHECK (SoLuongMonHoanTat >= 0),
    TongGiaTri DECIMAL(10, 2) CHECK (TongGiaTri >= 0),
    ThoiGianThanhToan DATETIME,
    PhuongPhapThanhToan VARCHAR(50),
    TinhTrang VARCHAR(50) DEFAULT 'Dang xu ly',  -- Trạng thái mặc định
    GhiChu TEXT,
    LoaiDH VARCHAR(20),
    CHECK (LoaiDH IN ('Dat truoc', 'Khong dat truoc')),
    NgayGhiNhan DATE,
    MaKH INT NULL,  -- Chấp nhận giá trị NULL
    ThoiGianHenGiao DATETIME,  -- Thời gian hẹn giao
    ThoiGianDatBan DATETIME,  -- Thời gian khách đặt bàn
    LyDoHuy TEXT,  -- Lý do huỷ
    MaKhuVuc INT,  -- Mã khu vực
    MaBan INT,     -- Mã bàn
    CONSTRAINT FK_DH_KH FOREIGN KEY (MaKH)
        REFERENCES KhachHang(MaKH) ON DELETE SET NULL,
    CONSTRAINT FK_DH_Ban FOREIGN KEY (MaKhuVuc, MaBan) 
        REFERENCES Ban(MaKhuVuc, MaBan) ON DELETE CASCADE  -- Ràng buộc khóa ngoại
);

-- Trigger tự huỷ đơn đến trễ 30p
DELIMITER //
CREATE TRIGGER UpdateStatusAfter30Min
AFTER INSERT ON DonHang
FOR EACH ROW
BEGIN
    IF NEW.LoaiDH = 'Dat truoc' AND NEW.ThoiGianDatBan IS NOT NULL THEN
        -- Cập nhật trạng thái đơn hàng sau 30 phút kể từ thời gian khách đặt bàn
        UPDATE DonHang
        SET 
            TinhTrang = 'Huy',
            LyDoHuy = 'Hủy do quá thời gian đặt bàn'  -- Lý do huỷ
        WHERE MaDH = NEW.MaDH
          AND TIMESTAMPDIFF(MINUTE, NEW.ThoiGianDatBan, NOW()) >= 30;
    END IF;
END;
//
DELIMITER ;

-- Tao Bang DH theo mon
CREATE TABLE DonHangChiTietTheoMon (
    MaCTDH INT PRIMARY KEY AUTO_INCREMENT,   -- Mã chi tiết đơn hàng
    MaDH INT,                                -- Mã đơn hàng
    MaMon INT,                               -- Mã món ăn
    TenMon VARCHAR(255),                     -- Tên món ăn
    SoLuong INT CHECK (SoLuong > 0),        -- Số lượng món ăn
    Gia DECIMAL(10, 2) CHECK (Gia >= 0),    -- Giá mỗi món
    GhiChu TEXT,                            -- Ghi chú về món ăn
    ThoiGianTao DATETIME DEFAULT CURRENT_TIMESTAMP,  -- Thời gian tạo
    CONSTRAINT FK_DHCT_DH FOREIGN KEY (MaDH)
        REFERENCES DonHang(MaDH) ON DELETE CASCADE,
    CONSTRAINT FK_DHCT_Mon FOREIGN KEY (MaMon)
        REFERENCES MonAn(MaMon) ON DELETE CASCADE
);

CREATE TABLE MonAn (
    MaMon INT PRIMARY KEY AUTO_INCREMENT,  -- Mã món ăn
    TenMon VARCHAR(100) NOT NULL,          -- Tên món ăn
    DonGiaGoc DECIMAL(10, 2) CHECK (DonGiaGoc >= 0),  -- Đơn giá gốc
    LoaiMon VARCHAR(20) CHECK (LoaiMon IN ('Chinh', 'Trang mieng', 'Nuoc')),  -- Ràng buộc loại món ăn
    GhiChu TEXT                            -- Ghi chú thêm về món ăn (nếu cần)
);

-- trigger nhập món tính tiền
DELIMITER //
CREATE TRIGGER AfterInsertDonHang
AFTER INSERT ON DonHang
FOR EACH ROW
BEGIN
    DECLARE totalMon INT DEFAULT 0;
    DECLARE totalPrice DECIMAL(10, 2) DEFAULT 0.00;
    -- Tạo bảng tạm thời
    CREATE TEMPORARY TABLE MonAnTam (
        MaMon INT,
        SoLuong INT,
        GhiChu TEXT
    );
    -- Chèn dữ liệu vào bảng tạm (giả định rằng dữ liệu đã có sẵn)
    -- Câu lệnh này có thể được thay thế bằng cách khác tùy thuộc vào nguồn dữ liệu
    INSERT INTO MonAnTam (MaMon, SoLuong, GhiChu)
    SELECT MaMon, SoLuong, GhiChu
    FROM <Nguồn dữ liệu>  -- CHỖ NÀY LÀM SAO ĐỂ LẤY DATA TỪ NGƯỜI DÙNG HOẶC KHÁCH CHỌN
    -- Thêm các món ăn từ bảng tạm vào bảng DonHangChiTietTheoMon
    INSERT INTO DonHangChiTietTheoMon (MaDH, MaMon, TenMon, SoLuong, Gia, GhiChu)
    SELECT NEW.MaDH, m.MaMon, m.TenMon, mt.SoLuong, m.DonGiaGoc, mt.GhiChu
    FROM MonAnTam mt
    JOIN MonAn m ON mt.MaMon = m.MaMon;
    -- Tính tổng số món và tổng giá trị
    SELECT COUNT(*) INTO totalMon, SUM(mt.SoLuong * m.DonGiaGoc) INTO totalPrice
    FROM MonAnTam mt
    JOIN MonAn m ON mt.MaMon = m.MaMon;
    -- Cập nhật tổng số món và tổng giá trị vào bảng DonHang
    UPDATE DonHang
    SET SoLuongMonHoanTat = totalMon,
        TongGiaTri = totalPrice
    WHERE MaDH = NEW.MaDH;
    -- Bảng tạm sẽ tự động xóa khi phiên làm việc kết thúc
END;
//
DELIMITER ;


CREATE TABLE CongThuc (
    MaCongThuc INT PRIMARY KEY AUTO_INCREMENT,  -- Mã công thức
    TenMon VARCHAR(100) NOT NULL,               -- Tên món ăn
    MoTa TEXT,                                   -- Mô tả công thức
    FOREIGN KEY (TenMon) REFERENCES MonAn(TenMon) ON DELETE CASCADE  -- Khóa ngoại liên kết với bảng MonAn
);

CREATE TABLE CongThucGomCo (
    MaCTGC INT PRIMARY KEY AUTO_INCREMENT,      -- Mã công thức gốc
    MaNguyenLieu INT NOT NULL,                  -- Mã nguyên liệu, liên kết với bảng NguyenLieu
    LieuLuong DECIMAL(10, 2) NOT NULL,         -- Liều lượng nguyên liệu
    MaCongThuc INT,                            -- Mã công thức liên kết
    FOREIGN KEY (MaNguyenLieu) REFERENCES NguyenLieu(MaNL) ON DELETE CASCADE,  -- Khóa ngoại liên kết với bảng NguyenLieu
    FOREIGN KEY (MaCongThuc) REFERENCES CongThuc(MaCongThuc) ON DELETE CASCADE  -- Khóa ngoại liên kết với bảng CongThuc
);

-- Hàm hiện món ăn còn đủ nguyên liệu ra 
DELIMITER //
CREATE FUNCTION HienThiMonAnCoSan()
RETURNS TABLE
BEGIN
    RETURN (
        SELECT M.MaMon, M.TenMon
        FROM MonAn M
        LEFT JOIN CongThuc CT ON M.MaMon = CT.MaMon
        LEFT JOIN CongThucGomCo CTGC ON CT.MaCongThuc = CTGC.MaCongThuc
        LEFT JOIN NguyenLieu NL ON CTGC.MaNguyenLieu = NL.MaNL
        GROUP BY M.MaMon, M.TenMon
        HAVING SUM(CASE WHEN CTGC.LieuLuong > NL.SoLuongTrongKho THEN 1 ELSE 0 END) = 0
    );
END;
//

CREATE TABLE BaoCaoDoanhThuTheoNgay (
    Ngay DATE PRIMARY KEY,            -- Ngày báo cáo
    TongSoMon INT DEFAULT 0,         -- Tổng số món trong ngày
    TongDoanhThu DECIMAL(10, 2) DEFAULT 0.00,  -- Tổng doanh thu trong ngày
    TongSoDonHang INT DEFAULT 0      -- Tổng số đơn hàng trong ngày
);

-- trigger DonHang qua BaoCao
DELIMITER //
CREATE TRIGGER AfterInsertDonHang
AFTER INSERT ON DonHang
FOR EACH ROW
BEGIN
    DECLARE ngay DATE;
    SET ngay = DATE(NEW.ThoiGianTao);  -- Lấy ngày từ trường ThoiGianTao
    -- Cập nhật báo cáo doanh thu
    INSERT INTO BaoCaoDoanhThuTheoNgay (Ngay, TongSoMon, TongDoanhThu, TongSoDonHang)
    VALUES (ngay, NEW.SoLuongMonHoanTat, NEW.TongGiaTri, 1)
    ON DUPLICATE KEY UPDATE
        TongSoMon = TongSoMon + NEW.SoLuongMonHoanTat,
        TongDoanhThu = TongDoanhThu + NEW.TongGiaTri,
        TongSoDonHang = TongSoDonHang + 1;
END;
//
DELIMITER ;


CREATE TABLE BaoCaoSoLuongMonTheoNgay (
    Ngay DATE,                           -- Ngày báo cáo
    MaMon INT,                           -- Mã món ăn
    TenMon VARCHAR(255),                 -- Tên món ăn
    TongSoLuong INT DEFAULT 0,           -- Tổng số lượng món đã bán
    TongDoanhThu DECIMAL(10, 2) DEFAULT 0.00,  -- Tổng doanh thu của món
    PRIMARY KEY (Ngay, MaMon)            -- Khóa chính gồm Ngày và Mã món
);

-- trigger tạo báo cáo theo món
DELIMITER //
CREATE TRIGGER AfterInsertDonHangChiTiet
AFTER INSERT ON DonHangChiTietTheoMon
FOR EACH ROW
BEGIN
    -- Cập nhật tổng số lượng và tổng doanh thu cho món ăn trong bảng báo cáo
    INSERT INTO BaoCaoSoLuongMonTheoNgay (Ngay, MaMon, TenMon, TongSoLuong, TongDoanhThu)
    VALUES (DATE(NEW.ThoiGianTao), NEW.MaMon, NEW.TenMon, NEW.SoLuong, NEW.Gia * NEW.SoLuong)
    ON DUPLICATE KEY UPDATE
        TongSoLuong = TongSoLuong + NEW.SoLuong,
        TongDoanhThu = TongDoanhThu + (NEW.Gia * NEW.SoLuong);
END;
//
DELIMITER ;

CREATE TABLE KhuVuc (
    MaKhuVuc INT PRIMARY KEY AUTO_INCREMENT,  -- Mã số khu vực, tự động tăng
    TenKhuVuc VARCHAR(255) NOT NULL            -- Tên khu vực
);

CREATE TABLE Ban (
    MaKhuVuc INT,                             -- Mã khu vực, khóa ngoại
    MaBan INT,                                -- Mã số bàn
    SoGhe INT NOT NULL,                       -- Số ghế của bàn
    PRIMARY KEY (MaKhuVuc, MaBan),           -- Khóa chính kết hợp
    CONSTRAINT FK_Ban_KhuVuc FOREIGN KEY (MaKhuVuc) 
        REFERENCES KhuVuc(MaKhuVuc) ON DELETE CASCADE  -- Ràng buộc khóa ngoại
);

-- View hiện ra những bàn bị chiếm, tự cập nhật khi có đơn hàng mới
DELIMITER //
CREATE FUNCTION GetDonHangDangPhucVu()
RETURNS TABLE (
    MaDH INT,
    ThoiGianTao DATETIME,
    SoLuongMonHoanTat INT,
    TongGiaTri DECIMAL(10, 2),
    ThoiGianThanhToan DATETIME,
    PhuongPhapThanhToan VARCHAR(50),
    TinhTrang VARCHAR(50),
    GhiChu TEXT,
    LoaiDH VARCHAR(20),
    NgayGhiNhan DATE,
    MaKH INT,
    ThoiGianHenGiao DATETIME,
    ThoiGianDatBan DATETIME,
    LyDoHuy TEXT,
    TenKhuVuc VARCHAR(255),
    MaBan INT,
    SoGhe INT
)
BEGIN
    RETURN (
        SELECT 
            dh.MaDH,
            dh.ThoiGianTao,
            dh.SoLuongMonHoanTat,
            dh.TongGiaTri,
            dh.ThoiGianThanhToan,
            dh.PhuongPhapThanhToan,
            dh.TinhTrang,
            dh.GhiChu,
            dh.LoaiDH,
            dh.NgayGhiNhan,
            dh.MaKH,
            dh.ThoiGianHenGiao,
            dh.ThoiGianDatBan,
            dh.LyDoHuy,
            kv.TenKhuVuc,
            b.MaBan,
            b.SoGhe
        FROM 
            DonHang dh
        JOIN 
            KhuVuc kv ON dh.MaKhuVuc = kv.MaKhuVuc
        JOIN 
            Ban b ON dh.MaKhuVuc = b.MaKhuVuc AND dh.MaBan = b.MaBan
        WHERE 
            dh.TinhTrang = 'Dang phục vụ' AND
            dh.LoaiDH = 'An tai cho' AND
            dh.MaKhuVuc IS NOT NULL AND
            dh.MaBan IS NOT NULL
    );
END;
//
DELIMITER ;

-- view lấu bàn chưa bị chiếm
DELIMITER //
CREATE FUNCTION GetBanChuaBiChiem()
RETURNS TABLE (
    MaBan INT,
    SoGhe INT,
    TenKhuVuc VARCHAR(255)
)
BEGIN
    RETURN (
        SELECT 
            b.MaBan,
            b.SoGhe,
            kv.TenKhuVuc
        FROM 
            Ban b
        JOIN 
            KhuVuc kv ON b.MaKhuVuc = kv.MaKhuVuc
        LEFT JOIN 
            DonHang dh ON b.MaKhuVuc = dh.MaKhuVuc AND b.MaBan = dh.MaBan AND dh.TinhTrang = 'Dang phục vụ'
        WHERE 
            dh.MaDH IS NULL
    );
END;
//
DELIMITER ;

-- Bảng ThucThi
CREATE TABLE ThucThi (
    MaMon INT,                                           -- Mã món ăn
    MaNVBep INT,                                        -- Mã nhân viên bếp
    MaNVPhucVu INT,                                     -- Mã nhân viên phục vụ
    ThoiGianNhan DATETIME DEFAULT CURRENT_TIMESTAMP,   -- Thời gian nhận món
    ThoiGianHoanTat DATETIME,                           -- Thời gian hoàn tất
    Status VARCHAR(50),                                  -- Trạng thái món ăn (Hoàn Thành, Đang Chuẩn Bị, Huỷ, ...)
    PRIMARY KEY (MaMon, MaNVBep, ThoiGianNhan),        -- Khóa chính kết hợp
    CONSTRAINT FK_ThucThi_Mon FOREIGN KEY (MaMon) 
        REFERENCES MonAn(MaMon) ON DELETE CASCADE,     -- Ràng buộc khóa ngoại với bảng món ăn
    CONSTRAINT FK_ThucThi_NhanVienBep FOREIGN KEY (MaNVBep) 
        REFERENCES NhanVienBep(MaNV) ON DELETE CASCADE, -- Ràng buộc khóa ngoại với bảng nhân viên bếp
    CONSTRAINT FK_ThucThi_NhanVienPhucVu FOREIGN KEY (MaNVPhucVu) 
        REFERENCES PhucVu(MaNV) ON DELETE CASCADE      -- Ràng buộc khóa ngoại với bảng nhân viên phục vụ
);

-- Hàm cho đầu bếp
DELIMITER //
CREATE FUNCTION GetMonAnTuDonHangDangPhucVu()
RETURNS TABLE (
    MaMon INT,
    TenDauBep VARCHAR(255),
    ThoiGianNhan DATETIME,
    ThoiGianHoanTat DATETIME,
    MaNVPhucVu INT,
    Status VARCHAR(50),
    MaDH INT  -- Mã đơn hàng
)
BEGIN
    RETURN (
        SELECT 
            t.MaMon,
            t.TenDauBep,
            t.ThoiGianNhan,
            t.ThoiGianHoanTat,
            t.MaNVPhucVu,
            t.Status,
            dh.MaDH
        FROM 
            ThucThi t
        JOIN 
            DonHang dh ON t.MaMon = dh.MaDH 
        WHERE 
            dh.TinhTrang = 'Dang phục vụ'  -- Lọc các đơn hàng đang phục vụ
    );
END;
//
DELIMITER ;



-- hàm xem thông tin nhân viên quản lý phòng ban:
DELIMITER //
CREATE FUNCTION GetDepartmentManagers()
RETURNS TABLE (
    MaPB INT,
    TenPB VARCHAR(100),
    MaQL INT,            -- Mã nhân viên quản lý
    TenQL VARCHAR(100),  -- Tên người quản lý
    NgayBatDau DATE      -- Ngày bắt đầu của người quản lý
)
BEGIN
    RETURN (
        SELECT 
            pb.MaPB,
            pb.TenPB,
            nv.MaNV AS MaQL,  -- Mã nhân viên quản lý
            nv.HoTen AS TenQL,  -- Tên người quản lý
            ql.NgayBatDau       -- Ngày bắt đầu của người quản lý
        FROM 
            PhongBan pb
        LEFT JOIN 
            QuanLy ql ON pb.MaPB = ql.MaPB  -- Kết nối với bảng QuanLy
        LEFT JOIN 
            NhanVien nv ON ql.MaNV = nv.MaNV  -- Kết nối với bảng NhanVien
        WHERE 
            ql.NgayBatDau = (
                SELECT MAX(NgayBatDau)
                FROM QuanLy
                WHERE MaPB = pb.MaPB
            )
    );
END;
//
DELIMITER ;

-- hàm đếm số nhân viên từ phòng ban, thừa kế hàm GetDepartmentManagers()
DELIMITER //
CREATE FUNCTION GetDepartmentInfo()
RETURNS TABLE (
    MaPB INT,
    TenPB VARCHAR(100),
    MaQL INT,
    TenQL VARCHAR(100),
    NgayBatDau DATE,
    SoNhanVien INT  -- Số lượng nhân viên
)
BEGIN
    RETURN (
        SELECT 
            dm.MaPB,
            dm.TenPB,
            dm.MaQL,
            dm.TenQL,
            dm.NgayBatDau,
            (SELECT COUNT(*) 
             FROM NhanVien nv 
             WHERE nv.MaQL = dm.MaQL) AS SoNhanVien  -- Đếm số nhân viên do người quản lý này quản lý
        FROM 
            GetDepartmentManagers() dm  -- Sử dụng hàm GetDepartmentManagers như một bảng
    );
END;
//
DELIMITER ;


-- hàm hiển thị thông tin chi tiết của NV
DELIMITER //
CREATE FUNCTION GetEmployeeDetails(employeeId INT)
RETURNS TABLE (
    MaNV INT,
    HoTen VARCHAR(100),
    LoaiNV VARCHAR(20),
    LuongCoBan DECIMAL(10, 2),
    LuongTheoGio DECIMAL(10, 2),
    NgayBatDau DATE,
    CaLam VARCHAR(50),
    TenQL VARCHAR(100),  -- Tên người quản lý
    TenPB VARCHAR(100)    -- Tên phòng ban
)
BEGIN
    DECLARE employeeType VARCHAR(20);
  
    -- Lấy loại nhân viên
    SELECT LoaiNV INTO employeeType FROM NhanVien WHERE MaNV = employeeId;

    -- Kiểm tra loại nhân viên và lấy thông tin tương ứng
    IF employeeType = 'Toan thoi gian' THEN
        RETURN (
            SELECT 
                nv.MaNV,
                nv.HoTen,
                nv.LoaiNV,
                nth.LuongCoBan,
                NULL AS LuongTheoGio,
                nv.NgayBatDau,
                NULL AS CaLam,
                dm.TenQL,  -- Tên người quản lý từ hàm GetDepartmentManagers
                dm.TenPB    -- Tên phòng ban từ hàm GetDepartmentManagers
            FROM 
                NhanVien nv
            JOIN 
                NhanVienToanThoiGian nth ON nv.MaNV = nth.MaNV
            LEFT JOIN 
                (SELECT * FROM GetDepartmentManagers() WHERE MaPB = nv.MaPB) AS dm ON 1=1
            WHERE 
                nv.MaNV = employeeId
        );
    ELSEIF employeeType = 'Ban thoi gian' THEN
        RETURN (
            SELECT 
                nv.MaNV,
                nv.HoTen,
                nv.LoaiNV,
                NULL AS LuongCoBan,
                nb.LuongTheoGio,
                nv.NgayBatDau,
                cl.Ca AS CaLam,
                dm.TenQL,  -- Tên người quản lý từ hàm GetDepartmentManagers
                dm.TenPB    -- Tên phòng ban từ hàm GetDepartmentManagers
            FROM 
                NhanVien nv
            JOIN 
                NhanVienBanThoiGian nb ON nv.MaNV = nb.MaNV
            LEFT JOIN 
                CaLam cl ON nv.MaNV = cl.MaNV
            LEFT JOIN 
                (SELECT * FROM GetDepartmentManagers() WHERE MaPB = nv.MaPB) AS dm ON 1=1
            WHERE 
                nv.MaNV = employeeId
        );
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Nhan vien khong ton tai hoac khong co loai nhan vien'; 
    END IF;
END;
//
DELIMITER ;



