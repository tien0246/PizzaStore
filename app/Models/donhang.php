<?php
require './connection.php';

$action = $_POST['action'] ?? $_GET['action'] ?? null;

switch ($action) {
    case 'getMonAn':
        getMonAn($pdo);
        break;
    case 'add':
        addDonHang($pdo);
        break;
    default:
        echo "Hành động không hợp lệ!";
}

function getMonAn($pdo) {
    $stmt = $pdo->query("SELECT MaMA, TenMA FROM MonAn");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='{$row['MaMA']}'>{$row['TenMA']}</option>";
    }
}

function addDonHang($pdo) {
    $khachHang = $_POST['khachHang'];
    $monAn = $_POST['monAn'];
    $soLuong = $_POST['soLuong'];

    try {
        $pdo->beginTransaction();
        $stmt = $pdo->prepare("INSERT INTO DonHang (KhachHang) VALUES (?)");
        $stmt->execute([$khachHang]);
        $donHangID = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO DonHangTheoMon (MaDH, MaMA, SoLuong) VALUES (?, ?, ?)");
        foreach ($monAn as $index => $maMonAn) {
            $stmt->execute([$donHangID, $maMonAn, $soLuong[$index]]);
        }

        $pdo->commit();
        echo "Tạo đơn hàng thành công!";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Lỗi: " . $e->getMessage();
    }
}
?>
