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
    -- MaNCC INT PRIMARY KEY AUTO_INCREMENT,
    TenNCC VARCHAR(100) PRIMARY KEY,
    SoNha VARCHAR(50) NOT NULL,
    TenDuong VARCHAR(100) NOT NULL,
    PhuongXa VARCHAR(100) NOT NULL,
    QuanHuyen VARCHAR(100) NOT NULL,
    TinhThanh VARCHAR(100) NOT NULL
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
    TinhTrang VARCHAR(50) DEFAULT 'Dang xu ly', 
    GhiChu TEXT,
    LoaiDH VARCHAR(20),
    CHECK (LoaiDH IN ('Dat truoc', 'Khong dat truoc')),
    NgayGhiNhan DATE,
    MaKH INT NULL,  
    ThoiGianHenGiao DATETIME,  -- Thời gian hẹn giao
    ThoiGianDatBan DATETIME,  -- Thời gian khách đặt bàn
    LyDoHuy TEXT,  -- Lý do huỷ
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
    MaKhuVuc INT NOT NULL, 
    MaBan INT NOT NULL,
    PRIMARY KEY (MaDH, MaKhuVuc),  -- Khóa chính là sự kết hợp giữa MaDH và MaKhuVuc
    CONSTRAINT FK_NoiphuVu_DonHang FOREIGN KEY (MaDH)
        REFERENCES DonHang(MaDH) ON DELETE CASCADE,  -- Ràng buộc khóa ngoại đến bảng DonHang
    CONSTRAINT FK_NoiphuVu_Ban FOREIGN KEY (MaKhuVuc, MaBan) 
        REFERENCES Ban(MaKhuVuc, MaBan) ON DELETE CASCADE  -- Ràng buộc khóa ngoại đến bảng Ban
);

CREATE TABLE MonAn (
    MaMon INT PRIMARY KEY AUTO_INCREMENT,  -- Mã món ăn
    TenMon VARCHAR(100) NOT NULL,          -- Tên món ăn
    DonGiaGoc DECIMAL(10, 2) CHECK (DonGiaGoc >= 0),  -- Đơn giá gốc
    LoaiMon VARCHAR(20) CHECK (LoaiMon IN ('Chinh', 'Trang mieng', 'Nuoc')),  -- Ràng buộc loại món ăn
    GhiChu TEXT       ,                     -- Ghi chú thêm về món ăn (nếu cần)
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
    Ngay DATE PRIMARY KEY,            -- Ngày báo cáo
    TongSoMon INT DEFAULT 0,         -- Tổng số món trong ngày
    TongDoanhThu DECIMAL(10, 2) DEFAULT 0.00,  -- Tổng doanh thu trong ngày
    TongSoDonHang INT DEFAULT 0      -- Tổng số đơn hàng trong ngày
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
