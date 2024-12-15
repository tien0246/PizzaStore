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
    MaPB INT
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
    Ca ENUM('sang', 'trua', 'toi') NOT NULL
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
ALTER TABLE NhanVien
ADD CONSTRAINT FK_NhanVien_PhongBan FOREIGN KEY (MaPB) 
    REFERENCES PhongBan(MaPB);

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
    TenNCC VARCHAR(100) PRIMARY KEY,
    SoNha VARCHAR(50) NOT NULL,
    TenDuong VARCHAR(100) NOT NULL,
    PhuongXa VARCHAR(100) NOT NULL,
    QuanHuyen VARCHAR(100) NOT NULL,
    TinhThanh VARCHAR(100) NOT NULL
);

CREATE TABLE NCC_SDT (
    TenNCC VARCHAR(100) NOT NULL,
    SDT VARCHAR(15) NOT NULL, 
    PRIMARY KEY (TenNCC, SDT) 
);

CREATE TABLE NCC_email (
    TenNCC VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL, 
    PRIMARY KEY (TenNCC, Email)
);

CREATE TABLE CungCap (
    MaNL INT,
    TenNCC VARCHAR(100) NOT NULL,
    MaNVKiemKho INT,
    SoLuongGiao INT CHECK (SoLuongGiao >= 0),
    SoLuongNhapKho INT CHECK (SoLuongNhapKho >= 0),
    ThoiGian DATETIME NOT NULL,
    LyDoSaiLech TEXT,
    PRIMARY KEY (TenNCC, MaNL),
    CONSTRAINT FK_CungCap_NguyenLieu FOREIGN KEY (MaNL)
        REFERENCES NguyenLieu(MaNL) ON DELETE restrict,
    CONSTRAINT FK_CungCap_NhaCungCap FOREIGN KEY (TenNCC)
        REFERENCES NhaCungCap(TenNCC) ON DELETE restrict,
    CONSTRAINT FK_CungCap_NhanVienKiemKho FOREIGN KEY (MaNVKiemKho)
        REFERENCES NhanVienKiemKho(MaNV) ON DELETE restrict
);

CREATE TABLE KhachHang (
    MaKH INT PRIMARY KEY AUTO_INCREMENT,
    HoTen VARCHAR(100),
    GioiTinh CHAR(1),
    CHECK (GioiTinh IN ('M', 'F')),
    SoDienThoai VARCHAR(15),
    SoNha VARCHAR(50),         
    TenDuong VARCHAR(100),     
    PhuongXa VARCHAR(100),     
    QuanHuyen VARCHAR(100),     
    TinhThanh VARCHAR(100),    
    LoaiKH VARCHAR(20),
    CHECK (LoaiKH IN ('Ca nhan', 'To chuc')),
    NgaySinh DATE,                     
    CCCD VARCHAR(12),
    MaSoThue INT,
    TenDonVi VARCHAR(100)
);


CREATE TABLE DonHang (
    MaDH INT PRIMARY KEY AUTO_INCREMENT,
    ThoiGianTao DATETIME NOT NULL,
    SoLuongMonHoanTat INT CHECK (SoLuongMonHoanTat >= 0),
    TongGiaTri DECIMAL(10, 2) CHECK (TongGiaTri >= 0),
    ThoiGianThanhToan DATETIME,
    PhuongPhapThanhToan VARCHAR(50),
    TinhTrang VARCHAR(50) DEFAULT 'Dang xu ly', 
    GhiChu TEXT,
    LoaiDH VARCHAR(20),
    CHECK (LoaiDH IN ('Dat truoc', 'Khong dat truoc')),
    NgayGhiNhan DATE,
    MaKH INT NULL,  
    ThoiGianHenGiao DATETIME,  -- Thời gian hẹn giao
    ThoiGianDatBan DATETIME,  -- Thời gian khách đặt bàn
    LyDoHuy TEXT,
    CONSTRAINT FK_DH_KH FOREIGN KEY (MaKH)
        REFERENCES KhachHang(MaKH) ON DELETE SET NULL
);

CREATE TABLE KhuVuc (
    MaKhuVuc VARCHAR(10) PRIMARY KEY, 
    TenKhuVuc VARCHAR(255) NOT NULL 
);

-- trig để thêm tiền tố KV cho KhuVuc
DELIMITER //
CREATE TRIGGER before_insert_KhuVuc
BEFORE INSERT ON KhuVuc
FOR EACH ROW
BEGIN
    DECLARE new_id INT;

    SELECT COALESCE(MAX(CAST(SUBSTRING(MaKhuVuc, 3) AS UNSIGNED)), 0) + 1 INTO new_id FROM KhuVuc;

    SET NEW.MaKhuVuc = CONCAT('KV', LPAD(new_id, 3, '0'));
END;
//
DELIMITER ;

CREATE TABLE Ban (
    MaKhuVuc VARCHAR(10),                             
    MaBan INT,                                
    SoGhe INT NOT NULL,                       
    PRIMARY KEY (MaKhuVuc, MaBan),           
    CONSTRAINT FK_Ban_KhuVuc FOREIGN KEY (MaKhuVuc) 
        REFERENCES KhuVuc(MaKhuVuc) ON DELETE CASCADE  
);

CREATE TABLE NoiPhucVu (
    MaDH INT NOT NULL,  
    MaKhuVuc VARCHAR(10) NOT NULL, 
    MaBan INT NOT NULL,
    PRIMARY KEY (MaDH, MaKhuVuc),  
    CONSTRAINT FK_NoiphuVu_DonHang FOREIGN KEY (MaDH)
        REFERENCES DonHang(MaDH) ON DELETE CASCADE,  
    CONSTRAINT FK_NoiphuVu_Ban FOREIGN KEY (MaKhuVuc, MaBan) 
        REFERENCES Ban(MaKhuVuc, MaBan) ON DELETE CASCADE 
);

CREATE TABLE MonAn (
    MaMon INT PRIMARY KEY AUTO_INCREMENT, 
    TenMon VARCHAR(100) NOT NULL,         
    DonGiaGoc DECIMAL(10, 2) CHECK (DonGiaGoc >= 0),  
    LoaiMon VARCHAR(20) CHECK (LoaiMon IN ('Chinh', 'Trang mieng', 'Nuoc')), 
    GhiChu TEXT       ,                 
    TenCT VARCHAR(100),
    UNIQUE (TenCT) 
);

-- Tao Bang DH theo mon
CREATE TABLE DonHangChiTietTheoMon (
    MaDH INT NOT NULL,                               
    MaMon INT NOT NULL,                              
    SoLuong INT CHECK (SoLuong > 0),                 
    Gia DECIMAL(10, 2) CHECK (Gia >= 0),             
    GhiChu TEXT,                                     
    ThoiGianTao DATETIME DEFAULT CURRENT_TIMESTAMP,  
    CONSTRAINT PK_DonHangChiTiet PRIMARY KEY (MaDH, MaMon),
    CONSTRAINT FK_DHCT_DH FOREIGN KEY (MaDH)
        REFERENCES DonHang(MaDH) ON DELETE CASCADE,
    CONSTRAINT FK_DHCT_Mon FOREIGN KEY (MaMon)
        REFERENCES MonAn(MaMon) ON DELETE CASCADE
);

CREATE TABLE CongThuc (
    TenCT VARCHAR(100) PRIMARY KEY,          
    MoTa TEXT,                             
    FOREIGN KEY (TenCT) REFERENCES MonAn(TenCT) ON DELETE CASCADE 
);

CREATE TABLE CongThucGomCo (
    MaNguyenLieu INT NOT NULL,                  
    TenCT VARCHAR(100) NOT NULL,              
    LieuLuong DECIMAL(10, 2) NOT NULL,         
    PRIMARY KEY (MaNguyenLieu, TenCT),          
    FOREIGN KEY (MaNguyenLieu) REFERENCES NguyenLieu(MaNL) ON DELETE CASCADE,  
    FOREIGN KEY (TenCT) REFERENCES CongThuc(TenCT) ON DELETE CASCADE  
);

-- PROCEDURE tự huỷ đơn đến trễ 30p
DELIMITER //

CREATE PROCEDURE UpdateExpiredOrders()
BEGIN
    -- Cập nhật trạng thái đơn hàng "Đặt trước" bị quá hạn (quá 30 phút từ thời gian đặt bàn)
    UPDATE DonHang
    SET TinhTrang = 'Hủy',
        LyDoHuy = 'Hủy do quá thời gian đặt bàn'
    WHERE LoaiDH = 'Dat truoc'
      AND TinhTrang = 'Dang xu ly'
      AND ThoiGianDatBan < NOW() - INTERVAL 30 MINUTE;
END;
//
DELIMITER ;

-- trigger nhập món tính tiền
DELIMITER //

CREATE TRIGGER AfterInsertDonHang
AFTER INSERT ON DonHang
FOR EACH ROW
BEGIN
    DECLARE totalMon INT DEFAULT 0;
    DECLARE totalPrice DECIMAL(10, 2) DEFAULT 0.00;

    -- Tính tổng số món và tổng giá trị của đơn hàng
    SELECT 
        COUNT(DISTINCT MaMon), 
        SUM(SoLuong * Gia)
    INTO 
        totalMon, 
        totalPrice
    FROM 
        DonHangChiTietTheoMon
    WHERE 
        MaDH = NEW.MaDH;

    -- Cập nhật tổng số món và tổng giá trị vào bảng DonHang
    UPDATE DonHang
    SET 
        SoLuongMonHoanTat = totalMon,
        TongGiaTri = totalPrice
    WHERE 
        MaDH = NEW.MaDH;
END;
//
DELIMITER ;



-- Hàm hiện món ăn còn đủ nguyên liệu ra 
DELIMITER //

CREATE PROCEDURE HienThiMonAnCoSan()
BEGIN
    SELECT M.MaMon, M.TenMon
    FROM MonAn M
    LEFT JOIN CongThuc CT ON M.TenCT = CT.TenCT
    LEFT JOIN CongThucGomCo CTGC ON CT.TenCT = CTGC.TenCT
    LEFT JOIN NguyenLieu NL ON CTGC.MaNguyenLieu = NL.MaNL
    GROUP BY M.MaMon, M.TenMon
    HAVING SUM(CASE WHEN CTGC.LieuLuong > NL.SoLuongTrongKho THEN 1 ELSE 0 END) = 0;
END;
//
DELIMITER ;


CREATE TABLE BaoCaoDoanhThuTheoNgay (
    Ngay DATE PRIMARY KEY,            
    TongSoMon INT DEFAULT 0,         
    TongDoanhThu DECIMAL(10, 2) DEFAULT 0.00, 
    TongSoDonHang INT DEFAULT 0  
);

-- trigger DonHang qua BaoCao
DELIMITER //
CREATE TRIGGER AfterInsertDonHangBaoCao
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
    INSERT INTO BaoCaoSoLuongMonTheoNgay (Ngay, MaMon, TongSoLuong, TongDoanhThu)
    VALUES (DATE(NEW.ThoiGianTao), NEW.MaMon, NEW.SoLuong, NEW.Gia * NEW.SoLuong)
    ON DUPLICATE KEY UPDATE
        TongSoLuong = TongSoLuong + NEW.SoLuong,
        TongDoanhThu = TongDoanhThu + (NEW.Gia * NEW.SoLuong);
END;
//
DELIMITER ;


-- View hiện ra những bàn bị chiếm, tự cập nhật khi có đơn hàng mới
DELIMITER //

CREATE PROCEDURE GetDonHangDangPhucVu()
BEGIN
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
        dh.TinhTrang = 'Dang phục vụ'
        AND dh.LoaiDH = 'An tai cho'
        AND dh.MaKhuVuc IS NOT NULL
        AND dh.MaBan IS NOT NULL;
END;
//
DELIMITER ;


-- view lấu bàn chưa bị chiếm
DELIMITER //

CREATE PROCEDURE GetBanChuaBiChiem()
BEGIN
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
        dh.MaDH IS NULL;
END;
//
DELIMITER ;


-- Bảng ThucThi
-- Bảng ThucThi
CREATE TABLE ThucThi (
    MaMon INT NOT NULL,                                    
    MaDH INT NOT NULL,                                     
    MaNVBep INT,                                          
    MaNVPhucVu INT,                                       -- Cột khóa ngoại
    ThoiGianNhan DATETIME DEFAULT CURRENT_TIMESTAMP,      
    ThoiGianHoanTat DATETIME,                            
    Status VARCHAR(50),                                    -- Trạng thái món ăn
    PRIMARY KEY (MaMon, MaDH, MaNVBep),                   
    CONSTRAINT FK_ThucThi_DonHangChiTiet FOREIGN KEY (MaMon, MaDH) 
        REFERENCES DonHangChiTietTheoMon(MaDH, MaMon) ON DELETE RESTRICT,  
    CONSTRAINT FK_ThucThi_NhanVienBep FOREIGN KEY (MaNVBep) 
        REFERENCES NhanVienBep(MaNV) ON DELETE RESTRICT,   
    CONSTRAINT FK_ThucThi_NhanVienPhucVu FOREIGN KEY (MaNVPhucVu) 
        REFERENCES PhucVu(MaNV) ON DELETE RESTRICT          
);

-- Hàm cho đầu bếp
DELIMITER //

CREATE PROCEDURE GetMonAnTuDonHangDangPhucVu()
BEGIN
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
        dh.TinhTrang = 'Dang phục vụ';
END;
//
DELIMITER ;

-- hàm xem thông tin nhân viên quản lý phòng ban:
DELIMITER //

CREATE PROCEDURE GetDepartmentManagers()
BEGIN
    SELECT 
        pb.MaPB,
        pb.TenPB,
        nv.MaNV AS MaQL,
        nv.HoTen AS TenQL,
        ql.NgayBatDau
    FROM 
        PhongBan pb
    LEFT JOIN 
        QuanLy ql ON pb.MaPB = ql.MaPB
    LEFT JOIN 
        NhanVien nv ON ql.MaNV = nv.MaNV
    WHERE 
        ql.NgayBatDau = (
            SELECT MAX(NgayBatDau)
            FROM QuanLy
            WHERE MaPB = pb.MaPB
        );
END;
//
DELIMITER ;


-- hàm đếm số nhân viên từ phòng ban, thừa kế hàm GetDepartmentManagers()
DELIMITER //

CREATE PROCEDURE GetDepartmentInfo()
BEGIN
    SELECT 
        dm.MaPB,
        dm.TenPB,
        dm.MaQL,
        dm.TenQL,
        dm.NgayBatDau,
        (SELECT COUNT(*) 
         FROM NhanVien nv 
         WHERE nv.MaPB = dm.MaPB) AS SoNhanVien
    FROM 
        (SELECT 
            pb.MaPB,
            pb.TenPB,
            nv.MaNV AS MaQL,
            nv.HoTen AS TenQL,
            ql.NgayBatDau
         FROM 
            PhongBan pb
         LEFT JOIN 
            QuanLy ql ON pb.MaPB = ql.MaPB
         LEFT JOIN 
            NhanVien nv ON ql.MaNV = nv.MaNV
         WHERE 
            ql.NgayBatDau = (
                SELECT MAX(NgayBatDau)
                FROM QuanLy
                WHERE MaPB = pb.MaPB
            )
        ) AS dm;
END;
//
DELIMITER ;


-- hàm hiển thị thông tin chi tiết của NV
DELIMITER //

CREATE PROCEDURE GetEmployeeDetails(IN employeeId INT)
BEGIN
    DECLARE employeeType VARCHAR(20);
    
    -- Lấy loại nhân viên
    SELECT LoaiNV INTO employeeType FROM NhanVien WHERE MaNV = employeeId;

    -- Kiểm tra loại nhân viên và trả về kết quả
    IF employeeType = 'Toan thoi gian' THEN
        SELECT 
            nv.MaNV,
            nv.HoTen,
            nv.LoaiNV,
            nth.LuongCoBan,
            NULL AS LuongTheoGio,
            nv.NgayBatDau,
            NULL AS CaLam,
            dm.TenQL,
            dm.TenPB
        FROM 
            NhanVien nv
        JOIN 
            NhanVienToanThoiGian nth ON nv.MaNV = nth.MaNV
        LEFT JOIN 
            (SELECT 
                pb.MaPB,
                pb.TenPB,
                nv.MaNV AS MaQL,
                nv.HoTen AS TenQL
             FROM 
                PhongBan pb
             LEFT JOIN 
                QuanLy ql ON pb.MaPB = ql.MaPB
             LEFT JOIN 
                NhanVien nv ON ql.MaNV = nv.MaNV
            ) AS dm ON dm.MaPB = nv.MaPB
        WHERE 
            nv.MaNV = employeeId;

    ELSEIF employeeType = 'Ban thoi gian' THEN
        SELECT 
            nv.MaNV,
            nv.HoTen,
            nv.LoaiNV,
            NULL AS LuongCoBan,
            nb.LuongTheoGio,
            nv.NgayBatDau,
            cl.Ca AS CaLam,
            dm.TenQL,
            dm.TenPB
        FROM 
            NhanVien nv
        JOIN 
            NhanVienBanThoiGian nb ON nv.MaNV = nb.MaNV
        LEFT JOIN 
            CaLam cl ON nv.MaNV = cl.MaNV
        LEFT JOIN 
            (SELECT 
                pb.MaPB,
                pb.TenPB,
                nv.MaNV AS MaQL,
                nv.HoTen AS TenQL
             FROM 
                PhongBan pb
             LEFT JOIN 
                QuanLy ql ON pb.MaPB = ql.MaPB
             LEFT JOIN 
                NhanVien nv ON ql.MaNV = nv.MaNV
            ) AS dm ON dm.MaPB = nv.MaPB
        WHERE 
            nv.MaNV = employeeId;

    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Nhan vien khong ton tai hoac khong co loai nhan vien';
    END IF;
END;
//
DELIMITER ;

-- ================================================
-- CRUD Stored Procedures for Main Tables
-- ================================================

-- NhanVien Table
DELIMITER //
CREATE PROCEDURE AddNhanVien(
    IN p_HoTen VARCHAR(100),
    IN p_NgaySinh DATE,
    IN p_CCCD VARCHAR(12),
    IN p_GioiTinh CHAR(1),
    IN p_SoDienThoai VARCHAR(15),
    IN p_SoNha VARCHAR(255),
    IN p_Duong VARCHAR(255),
    IN p_Xa VARCHAR(255),
    IN p_Huyen VARCHAR(255),
    IN p_Tinh VARCHAR(255),
    IN p_MaPB INT
)
BEGIN
    INSERT INTO NhanVien (
        HoTen, NgaySinh, CanCuocCongDan, GioiTinh, 
        SoDienThoai, SoNha, Duong, Xa, Huyen, Tinh, MaPB
    ) VALUES (
        p_HoTen, p_NgaySinh, p_CCCD, p_GioiTinh, 
        p_SoDienThoai, p_SoNha, p_Duong, p_Xa, p_Huyen, p_Tinh, p_MaPB
    );
END;
//
CREATE PROCEDURE GetAllNhanVien()
BEGIN
    SELECT * FROM NhanVien;
END;
//
CREATE PROCEDURE GetNhanVienById(
    IN p_MaNV INT
)
BEGIN
    SELECT * FROM NhanVien WHERE MaNV = p_MaNV;
END;
//
CREATE PROCEDURE UpdateNhanVien(
    IN p_MaNV INT,
    IN p_HoTen VARCHAR(100),
    IN p_NgaySinh DATE,
    IN p_CCCD VARCHAR(12),
    IN p_GioiTinh CHAR(1),
    IN p_SoDienThoai VARCHAR(15),
    IN p_SoNha VARCHAR(255),
    IN p_Duong VARCHAR(255),
    IN p_Xa VARCHAR(255),
    IN p_Huyen VARCHAR(255),
    IN p_Tinh VARCHAR(255),
    IN p_MaPB INT
)
BEGIN
    UPDATE NhanVien
    SET 
        HoTen = p_HoTen,
        NgaySinh = p_NgaySinh,
        CanCuocCongDan = p_CCCD,
        GioiTinh = p_GioiTinh,
        SoDienThoai = p_SoDienThoai,
        SoNha = p_SoNha,
        Duong = p_Duong,
        Xa = p_Xa,
        Huyen = p_Huyen,
        Tinh = p_Tinh,
        MaPB = p_MaPB
    WHERE MaNV = p_MaNV;
END;
//
CREATE PROCEDURE DeleteNhanVien(
    IN p_MaNV INT
)
BEGIN
    DELETE FROM NhanVien WHERE MaNV = p_MaNV;
END;
//

-- PhongBan Table
CREATE PROCEDURE AddPhongBan(
    IN p_TenPB VARCHAR(100),
    IN p_MaPBQuanLy INT
)
BEGIN
    INSERT INTO PhongBan (TenPB, MaPBQuanLy)
    VALUES (p_TenPB, p_MaPBQuanLy);
END;
//
CREATE PROCEDURE GetAllPhongBan()
BEGIN
    SELECT * FROM PhongBan;
END;
//
CREATE PROCEDURE GetPhongBanByMaPB(
    IN p_MaPB INT
)
BEGIN
    SELECT * FROM PhongBan WHERE MaPB = p_MaPB;
END;
//
CREATE PROCEDURE UpdatePhongBan(
    IN p_MaPB INT,
    IN p_TenPB VARCHAR(100),
    IN p_MaPBQuanLy INT
)
BEGIN
    UPDATE PhongBan
    SET 
        TenPB = p_TenPB,
        MaPBQuanLy = p_MaPBQuanLy
    WHERE MaPB = p_MaPB;
END;
//
CREATE PROCEDURE DeletePhongBan(
    IN p_MaPB INT
)
BEGIN
    DELETE FROM PhongBan WHERE MaPB = p_MaPB;
END;
//

-- NhaCungCap Table
CREATE PROCEDURE AddNhaCungCap(
    IN p_TenNCC VARCHAR(100),
    IN p_SoNha VARCHAR(50),
    IN p_TenDuong VARCHAR(100),
    IN p_PhuongXa VARCHAR(100),
    IN p_QuanHuyen VARCHAR(100),
    IN p_TinhThanh VARCHAR(100)
)
BEGIN
    INSERT INTO NhaCungCap (TenNCC, SoNha, TenDuong, PhuongXa, QuanHuyen, TinhThanh)
    VALUES (p_TenNCC, p_SoNha, p_TenDuong, p_PhuongXa, p_QuanHuyen, p_TinhThanh);
END;
//
CREATE PROCEDURE GetAllNhaCungCap()
BEGIN
    SELECT * FROM NhaCungCap;
END;
//
CREATE PROCEDURE GetNhaCungCapByTenNCC(
    IN p_TenNCC VARCHAR(100)
)
BEGIN
    SELECT * FROM NhaCungCap WHERE TenNCC = p_TenNCC;
END;
//
CREATE PROCEDURE UpdateNhaCungCap(
    IN p_TenNCC VARCHAR(100),
    IN p_SoNha VARCHAR(50),
    IN p_TenDuong VARCHAR(100),
    IN p_PhuongXa VARCHAR(100),
    IN p_QuanHuyen VARCHAR(100),
    IN p_TinhThanh VARCHAR(100)
)
BEGIN
    UPDATE NhaCungCap
    SET 
        SoNha = p_SoNha,
        TenDuong = p_TenDuong,
        PhuongXa = p_PhuongXa,
        QuanHuyen = p_QuanHuyen,
        TinhThanh = p_TinhThanh
    WHERE TenNCC = p_TenNCC;
END;
//
CREATE PROCEDURE DeleteNhaCungCap(
    IN p_TenNCC VARCHAR(100)
)
BEGIN
    DELETE FROM NhaCungCap WHERE TenNCC = p_TenNCC;
END;
//

-- NguyenLieu Table
CREATE PROCEDURE AddNguyenLieu(
    IN p_TenNguyenLieu VARCHAR(100),
    IN p_DonViTinh VARCHAR(50),
    IN p_LoSanXuat VARCHAR(50),
    IN p_SoLuongTrongKho INT
)
BEGIN
    INSERT INTO NguyenLieu (TenNguyenLieu, DonViTinh, LoSanXuat, SoLuongTrongKho)
    VALUES (p_TenNguyenLieu, p_DonViTinh, p_LoSanXuat, p_SoLuongTrongKho);
END;
//
CREATE PROCEDURE GetAllNguyenLieu()
BEGIN
    SELECT * FROM NguyenLieu;
END;
//
CREATE PROCEDURE GetNguyenLieuByMaNL(
    IN p_MaNL INT
)
BEGIN
    SELECT * FROM NguyenLieu WHERE MaNL = p_MaNL;
END;
//
CREATE PROCEDURE UpdateNguyenLieu(
    IN p_MaNL INT,
    IN p_TenNguyenLieu VARCHAR(100),
    IN p_DonViTinh VARCHAR(50),
    IN p_LoSanXuat VARCHAR(50),
    IN p_SoLuongTrongKho INT
)
BEGIN
    UPDATE NguyenLieu
    SET 
        TenNguyenLieu = p_TenNguyenLieu,
        DonViTinh = p_DonViTinh,
        LoSanXuat = p_LoSanXuat,
        SoLuongTrongKho = p_SoLuongTrongKho
    WHERE MaNL = p_MaNL;
END;
//
CREATE PROCEDURE DeleteNguyenLieu(
    IN p_MaNL INT
)
BEGIN
    DELETE FROM NguyenLieu WHERE MaNL = p_MaNL;
END;
//

-- KhuVuc Table
CREATE PROCEDURE AddKhuVuc(
    IN p_TenKhuVuc VARCHAR(255)
)
BEGIN
    INSERT INTO KhuVuc (TenKhuVuc)
    VALUES (p_TenKhuVuc);
END;
//
CREATE PROCEDURE GetAllKhuVuc()
BEGIN
    SELECT * FROM KhuVuc;
END;
//
CREATE PROCEDURE GetKhuVucByMaKhuVuc(
    IN p_MaKhuVuc VARCHAR(10)
)
BEGIN
    SELECT * FROM KhuVuc WHERE MaKhuVuc = p_MaKhuVuc;
END;
//
CREATE PROCEDURE UpdateKhuVuc(
    IN p_MaKhuVuc VARCHAR(10),
    IN p_TenKhuVuc VARCHAR(255)
)
BEGIN
    UPDATE KhuVuc
    SET TenKhuVuc = p_TenKhuVuc
    WHERE MaKhuVuc = p_MaKhuVuc;
END;
//
CREATE PROCEDURE DeleteKhuVuc(
    IN p_MaKhuVuc VARCHAR(10)
)
BEGIN
    DELETE FROM KhuVuc WHERE MaKhuVuc = p_MaKhuVuc;
END;
//

-- Ban Table
CREATE PROCEDURE AddBan(
    IN p_MaKhuVuc VARCHAR(10),
    IN p_MaBan INT,
    IN p_SoGhe INT
)
BEGIN
    INSERT INTO Ban (MaKhuVuc, MaBan, SoGhe)
    VALUES (p_MaKhuVuc, p_MaBan, p_SoGhe);
END;
//
CREATE PROCEDURE GetAllBan()
BEGIN
    SELECT * FROM Ban;
END;
//
CREATE PROCEDURE GetBanByMaKhuVucMaBan(
    IN p_MaKhuVuc VARCHAR(10),
    IN p_MaBan INT
)
BEGIN
    SELECT * FROM Ban 
    WHERE MaKhuVuc = p_MaKhuVuc AND MaBan = p_MaBan;
END;
//
CREATE PROCEDURE UpdateBan(
    IN p_MaKhuVuc VARCHAR(10),
    IN p_MaBan INT,
    IN p_SoGhe INT
)
BEGIN
    UPDATE Ban
    SET SoGhe = p_SoGhe
    WHERE MaKhuVuc = p_MaKhuVuc AND MaBan = p_MaBan;
END;
//
CREATE PROCEDURE DeleteBan(
    IN p_MaKhuVuc VARCHAR(10),
    IN p_MaBan INT
)
BEGIN
    DELETE FROM Ban 
    WHERE MaKhuVuc = p_MaKhuVuc AND MaBan = p_MaBan;
END;
//

-- KhachHang Table
CREATE PROCEDURE AddKhachHang(
    IN p_HoTen VARCHAR(100),
    IN p_GioiTinh CHAR(1),
    IN p_SoDienThoai VARCHAR(15),
    IN p_SoNha VARCHAR(50),
    IN p_TenDuong VARCHAR(100),
    IN p_PhuongXa VARCHAR(100),
    IN p_QuanHuyen VARCHAR(100),
    IN p_TinhThanh VARCHAR(100),
    IN p_LoaiKH VARCHAR(20),
    IN p_NgaySinh DATE,
    IN p_CCCD VARCHAR(12)
)
BEGIN
    INSERT INTO KhachHang (
        HoTen, GioiTinh, SoDienThoai, SoNha, 
        TenDuong, PhuongXa, QuanHuyen, TinhThanh, 
        LoaiKH, NgaySinh, CCCD
    ) VALUES (
        p_HoTen, p_GioiTinh, p_SoDienThoai, p_SoNha, 
        p_TenDuong, p_PhuongXa, p_QuanHuyen, p_TinhThanh, 
        p_LoaiKH, p_NgaySinh, p_CCCD
    );
END;
//
CREATE PROCEDURE GetAllKhachHang()
BEGIN
    SELECT * FROM KhachHang;
END;
//
CREATE PROCEDURE GetKhachHangByMaKH(
    IN p_MaKH INT
)
BEGIN
    SELECT * FROM KhachHang WHERE MaKH = p_MaKH;
END;
//
CREATE PROCEDURE UpdateKhachHang(
    IN p_MaKH INT,
    IN p_HoTen VARCHAR(100),
    IN p_GioiTinh CHAR(1),
    IN p_SoDienThoai VARCHAR(15),
    IN p_SoNha VARCHAR(50),
    IN p_TenDuong VARCHAR(100),
    IN p_PhuongXa VARCHAR(100),
    IN p_QuanHuyen VARCHAR(100),
    IN p_TinhThanh VARCHAR(100),
    IN p_LoaiKH VARCHAR(20),
    IN p_NgaySinh DATE,
    IN p_CCCD VARCHAR(12)
)
BEGIN
    UPDATE KhachHang
    SET 
        HoTen = p_HoTen,
        GioiTinh = p_GioiTinh,
        SoDienThoai = p_SoDienThoai,
        SoNha = p_SoNha,
        TenDuong = p_TenDuong,
        PhuongXa = p_PhuongXa,
        QuanHuyen = p_QuanHuyen,
        TinhThanh = p_TinhThanh,
        LoaiKH = p_LoaiKH,
        NgaySinh = p_NgaySinh,
        CCCD = p_CCCD
    WHERE MaKH = p_MaKH;
END;
//
CREATE PROCEDURE DeleteKhachHang(
    IN p_MaKH INT
)
BEGIN
    DELETE FROM KhachHang WHERE MaKH = p_MaKH;
END;
//

-- DonHang Table
CREATE PROCEDURE AddDonHang(
    IN p_ThoiGianTao DATETIME,
    IN p_SoLuongMonHoanTat INT,
    IN p_TongGiaTri DECIMAL(10, 2),
    IN p_ThoiGianThanhToan DATETIME,
    IN p_PhuongPhapThanhToan VARCHAR(50),
    IN p_TinhTrang VARCHAR(50),
    IN p_GhiChu TEXT,
    IN p_LoaiDH VARCHAR(20),
    IN p_NgayGhiNhan DATE,
    IN p_MaKH INT,
    IN p_ThoiGianHenGiao DATETIME,
    IN p_ThoiGianDatBan DATETIME,
    IN p_LyDoHuy TEXT
)
BEGIN
    INSERT INTO DonHang (
        ThoiGianTao, SoLuongMonHoanTat, TongGiaTri, ThoiGianThanhToan,
        PhuongPhapThanhToan, TinhTrang, GhiChu, LoaiDH,
        NgayGhiNhan, MaKH, ThoiGianHenGiao, ThoiGianDatBan, LyDoHuy
    ) VALUES (
        p_ThoiGianTao, p_SoLuongMonHoanTat, p_TongGiaTri, p_ThoiGianThanhToan,
        p_PhuongPhapThanhToan, p_TinhTrang, p_GhiChu, p_LoaiDH,
        p_NgayGhiNhan, p_MaKH, p_ThoiGianHenGiao, p_ThoiGianDatBan, p_LyDoHuy
    );
END;
//
CREATE PROCEDURE GetAllDonHang()
BEGIN
    SELECT * FROM DonHang;
END;
//
CREATE PROCEDURE GetDonHangByMaDH(
    IN p_MaDH INT
)
BEGIN
    SELECT * FROM DonHang WHERE MaDH = p_MaDH;
END;
//
CREATE PROCEDURE UpdateDonHang(
    IN p_MaDH INT,
    IN p_ThoiGianTao DATETIME,
    IN p_SoLuongMonHoanTat INT,
    IN p_TongGiaTri DECIMAL(10, 2),
    IN p_ThoiGianThanhToan DATETIME,
    IN p_PhuongPhapThanhToan VARCHAR(50),
    IN p_TinhTrang VARCHAR(50),
    IN p_GhiChu TEXT,
    IN p_LoaiDH VARCHAR(20),
    IN p_NgayGhiNhan DATE,
    IN p_MaKH INT,
    IN p_ThoiGianHenGiao DATETIME,
    IN p_ThoiGianDatBan DATETIME,
    IN p_LyDoHuy TEXT
)
BEGIN
    UPDATE DonHang
    SET 
        ThoiGianTao = p_ThoiGianTao,
        SoLuongMonHoanTat = p_SoLuongMonHoanTat,
        TongGiaTri = p_TongGiaTri,
        ThoiGianThanhToan = p_ThoiGianThanhToan,
        PhuongPhapThanhToan = p_PhuongPhapThanhToan,
        TinhTrang = p_TinhTrang,
        GhiChu = p_GhiChu,
        LoaiDH = p_LoaiDH,
        NgayGhiNhan = p_NgayGhiNhan,
        MaKH = p_MaKH,
        ThoiGianHenGiao = p_ThoiGianHenGiao,
        ThoiGianDatBan = p_ThoiGianDatBan,
        LyDoHuy = p_LyDoHuy
    WHERE MaDH = p_MaDH;
END;
//
CREATE PROCEDURE DeleteDonHang(
    IN p_MaDH INT
)
BEGIN
    DELETE FROM DonHang WHERE MaDH = p_MaDH;
END;
//

-- MonAn Table
CREATE PROCEDURE AddMonAn(
    IN p_TenMon VARCHAR(100),
    IN p_DonGiaGoc DECIMAL(10, 2),
    IN p_LoaiMon VARCHAR(20),
    IN p_GhiChu TEXT,
    IN p_TenCT VARCHAR(100)
)
BEGIN
    INSERT INTO MonAn (TenMon, DonGiaGoc, LoaiMon, GhiChu, TenCT)
    VALUES (p_TenMon, p_DonGiaGoc, p_LoaiMon, p_GhiChu, p_TenCT);
END;
//
CREATE PROCEDURE GetAllMonAn()
BEGIN
    SELECT * FROM MonAn;
END;
//
CREATE PROCEDURE GetMonAnByMaMon(
    IN p_MaMon INT
)
BEGIN
    SELECT * FROM MonAn WHERE MaMon = p_MaMon;
END;
//
CREATE PROCEDURE UpdateMonAn(
    IN p_MaMon INT,
    IN p_TenMon VARCHAR(100),
    IN p_DonGiaGoc DECIMAL(10, 2),
    IN p_LoaiMon VARCHAR(20),
    IN p_GhiChu TEXT,
    IN p_TenCT VARCHAR(100)
)
BEGIN
    UPDATE MonAn
    SET 
        TenMon = p_TenMon,
        DonGiaGoc = p_DonGiaGoc,
        LoaiMon = p_LoaiMon,
        GhiChu = p_GhiChu,
        TenCT = p_TenCT
    WHERE MaMon = p_MaMon;
END;
//
CREATE PROCEDURE DeleteMonAn(
    IN p_MaMon INT
)
BEGIN
    DELETE FROM MonAn WHERE MaMon = p_MaMon;
END;
//

-- BaoCaoDoanhThuTheoNgay Table
CREATE PROCEDURE AddBaoCaoDoanhThuTheoNgay(
    IN p_Ngay DATE,
    IN p_TongSoMon INT,
    IN p_TongDoanhThu DECIMAL(10, 2),
    IN p_TongSoDonHang INT
)
BEGIN
    INSERT INTO BaoCaoDoanhThuTheoNgay (Ngay, TongSoMon, TongDoanhThu, TongSoDonHang)
    VALUES (p_Ngay, p_TongSoMon, p_TongDoanhThu, p_TongSoDonHang);
END;
//
CREATE PROCEDURE GetAllBaoCaoDoanhThuTheoNgay()
BEGIN
    SELECT * FROM BaoCaoDoanhThuTheoNgay;
END;
//
CREATE PROCEDURE GetBaoCaoDoanhThuTheoNgayByNgay(
    IN p_Ngay DATE
)
BEGIN
    SELECT * FROM BaoCaoDoanhThuTheoNgay WHERE Ngay = p_Ngay;
END;
//
CREATE PROCEDURE UpdateBaoCaoDoanhThuTheoNgay(
    IN p_Ngay DATE,
    IN p_TongSoMon INT,
    IN p_TongDoanhThu DECIMAL(10, 2),
    IN p_TongSoDonHang INT
)
BEGIN
    UPDATE BaoCaoDoanhThuTheoNgay
    SET 
        TongSoMon = p_TongSoMon,
        TongDoanhThu = p_TongDoanhThu,
        TongSoDonHang = p_TongSoDonHang
    WHERE Ngay = p_Ngay;
END;
//
CREATE PROCEDURE DeleteBaoCaoDoanhThuTheoNgay(
    IN p_Ngay DATE
)
BEGIN
    DELETE FROM BaoCaoDoanhThuTheoNgay WHERE Ngay = p_Ngay;
END;
//

-- BaoCaoSoLuongMonTheoNgay Table
CREATE PROCEDURE AddBaoCaoSoLuongMonTheoNgay(
    IN p_Ngay DATE,
    IN p_MaMon INT,
    IN p_TenMon VARCHAR(255),
    IN p_TongSoLuong INT,
    IN p_TongDoanhThu DECIMAL(10, 2)
)
BEGIN
    INSERT INTO BaoCaoSoLuongMonTheoNgay (
        Ngay, MaMon, TenMon, TongSoLuong, TongDoanhThu
    ) VALUES (
        p_Ngay, p_MaMon, p_TenMon, p_TongSoLuong, p_TongDoanhThu
    );
END;
//
CREATE PROCEDURE GetAllBaoCaoSoLuongMonTheoNgay()
BEGIN
    SELECT * FROM BaoCaoSoLuongMonTheoNgay;
END;
//
CREATE PROCEDURE GetBaoCaoSoLuongMonTheoNgayByNgayMaMon(
    IN p_Ngay DATE,
    IN p_MaMon INT
)
BEGIN
    SELECT * FROM BaoCaoSoLuongMonTheoNgay 
    WHERE Ngay = p_Ngay AND MaMon = p_MaMon;
END;
//
CREATE PROCEDURE UpdateBaoCaoSoLuongMonTheoNgay(
    IN p_Ngay DATE,
    IN p_MaMon INT,
    IN p_TongSoLuong INT,
    IN p_TongDoanhThu DECIMAL(10, 2)
)
BEGIN
    UPDATE BaoCaoSoLuongMonTheoNgay
    SET 
        TongSoLuong = p_TongSoLuong,
        TongDoanhThu = p_TongDoanhThu
    WHERE Ngay = p_Ngay AND MaMon = p_MaMon;
END;
//
CREATE PROCEDURE DeleteBaoCaoSoLuongMonTheoNgay(
    IN p_Ngay DATE,
    IN p_MaMon INT
)
BEGIN
    DELETE FROM BaoCaoSoLuongMonTheoNgay 
    WHERE Ngay = p_Ngay AND MaMon = p_MaMon;
END;
//
CREATE PROCEDURE "GetMonChuaHoanThanh"()
BEGIN
    SELECT * FROM ThucThi
    WHERE Status = 'Chưa hoàn thành';
END
//
CREATE PROCEDURE "UpdateStatusThucThi"(
    IN p_MaDH INT,
    IN p_MaMon INT
)
BEGIN
    UPDATE ThucThi
    SET 
        Status = 'Hoàn thành', ThoiGianHoanTat = CONVERT_TZ(NOW(), 'UTC', 'Asia/Ho_Chi_Minh')
    WHERE MaDH = p_MaDH AND MaMon = p_MaMon;
END
