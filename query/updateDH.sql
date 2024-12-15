DELIMITER //
CREATE TRIGGER AfterUpdateDonHangChiTiet
AFTER UPDATE ON DonHangChiTietTheoMon
FOR EACH ROW
BEGIN
    DECLARE totalMon INT DEFAULT 0;
    DECLARE totalPrice DECIMAL(10, 2) DEFAULT 0.00;
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

    UPDATE DonHang
    SET 
        SoLuongMonHoanTat = totalMon,
        TongGiaTri = totalPrice
    WHERE 
        MaDH = NEW.MaDH;
END //
DELIMITER ;
