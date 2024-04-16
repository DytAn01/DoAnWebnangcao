<?php
include "dbconnect.php";
if ($conn) {

    $id = $_GET['id'];
    $sql =  "SELECT sanpham.maSP, sanpham.tenSP, sanpham.dongia, sanpham.img_src, sanpham.soluong,
    kieudang.ten AS tenkieudang, chatlieusp.ten AS tenchatlieu, doituongsd.ten AS tendoituongsd
    FROM sanpham, kieudang, chatlieusp, doituongsd
    WHERE sanpham.maSP = $id
    AND sanpham.makieudang = kieudang.ma 
    AND sanpham.machatlieu = chatlieusp.ma
    AND sanpham.madoituongsd = doituongsd.ma";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $maSP = $row['maSP'];
        $tenSP = $row['tenSP'];
        $donGia = $row['dongia'];
        $img = $row['img_src'];
        $soLuong = $row['soluong'];
        $kieuDang = $row['tenkieudang'];
        $chatLieu = $row['tenchatlieu'];
        $doiTuongSD = $row['tendoituongsd'];

        $chiTietSanPham = [
            'maSP' => $maSP,
            'tenSP' => $tenSP,
            'donGia' => $donGia,
            'img' => $img,
            'soLuong' => $soLuong,
            'kieuDang' => $kieuDang,
            'chatLieu' => $chatLieu,
            'doiTuongSD' => $doiTuongSD
        ];
        header('Content-Type: application/json');
        echo json_encode($chiTietSanPham);
    } else {
        $chiTietSanPham = [
            'error' => 'Sản phẩm không tồn tại'
        ];
        header('Content-Type: application/json');
    }

    mysqli_close($conn);

}
