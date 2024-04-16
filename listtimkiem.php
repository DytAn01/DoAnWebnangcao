<?php
include "dbconnect.php";
if ($conn) {

    $name = '';
    if (isset($_GET['name']) && $_GET['name'] !== '') {
        $name = $_GET['name'];
        $sql = "SELECT * FROM sanpham
                WHERE tenSP LIKE '%$name%'
        ";
    } else {
        $sql = "SELECT * FROM sanpham";
        
    }

    $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $listSanPham[] = $row;
        }
    // Sắp xếp sản phẩm theo giá tăng
    $listSanPhamGiaTang = $listSanPham;
    usort($listSanPhamGiaTang, function ($a, $b) {
        return $a['dongia'] - $b['dongia'];
    });

    // Sắp xếp sản phẩm theo giá giảm
    $listSanPhamGiaGiam = $listSanPham;
    usort($listSanPhamGiaGiam, function ($a, $b) {
        return $b['dongia'] - $a['dongia'];
    });

    mysqli_close($conn);

    if ($_GET['type'] === 'sanPhamTheoGiaTang') {
        $data = $listSanPhamGiaTang;
    } else if ($_GET['type'] === 'sanPhamTheoGiaGiam') {
        $data = $listSanPhamGiaGiam;
    } else {
        $data = $listSanPham;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}
