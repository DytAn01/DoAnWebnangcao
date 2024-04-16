<?php
include "dbconnect.php";
if ($conn) {

    $shape = $_GET['shape'];
    $material = $_GET['material'];
    $sex = $_GET['sex'];
    $shapeString = '(' . implode(',', $shape) . ')'; 
    $materialString = '(' . implode(',', $material) . ')'; 
    $sexString = '(' . implode(',', $sex) . ')'; 
    $name = '';
    $sql_shape = '';
    $sql_material = '';
    $sql_sex = '';

    if (count($shape) > 0) {
        $sql_kd .= ' AND makieudang IN ' . $shapeString . ' ';
    }

    if (count($material) > 0) {
        $sql_cl .= ' AND machatlieu IN ' . $materialString . ' ';
    }

    if (count($sex) > 0) {
        $sql_gt .= ' AND madoituongsd IN ' . $sexString . ' ';
    }

    if (isset($_GET['name']) && $_GET['name'] !== '') {
        $name = $_GET['name'];
        $sql = "SELECT * FROM sanpham
            WHERE tenSP LIKE '%$name%'
            $sql_kd
            $sql_cl
            $sql_gt
    ";
    } else {
        $sql = "SELECT * FROM sanpham
            WHERE 1=1 
            $sql_kd
            $sql_cl
            $sql_gt
    ";
    }
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $listSanPham[] = $row;
    }
    if (isset($listSanPham) && is_array($listSanPham)) {
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
    } else {
        echo "Không có sản phẩm";
    }
}
