<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/367278d2a4.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="/js/ajax.js"></script> -->
</head>

<script>
    //--------slider------------
    $(function() {
        $('.slide-show img:gt(0)').hide();
        setInterval(function() {
            $('.slide-show :first-child').fadeOut().next('img').fadeIn().end().appendTo('.slide-show');
        }, 3000);
    });
</script>



<body>
    <?php
    include "dbconnect.php";
    ?>
    <div class="header-contain">
        <div class="heading">
            <div class="header-logo">
                <!-- <img src="images/logo.png" alt=""> -->
            </div>
            <div class="header-content">
                <!---------------------------top menu------------------>
                <div class="header-top-menu">
                    <ul>
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#"> Lịch sử đơn hàng </a></li>
                        <li><a href="#"> Theo dõi đơn hàng </a></li>
                        <li><a href="signup.php"> Đăng kí </a></li>
                        <li><a href="signin.php"> Đăng nhập </a></li>
                        <i class="fa-solid fa-cart-shopping"> </i>
                    </ul>
                </div>
                <div class="search-bar">
                    <input type="search" id="search-box" n value="" placeholder="Nhập từ khóa" autocomplete="off">
                    <button class="search-button" type="submit" onclick="timKiemSanPham()">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button class="filter-search-button">
                        Bộ lọc
                    </button>
                    <div class="filter-search">
                        <div>
                            <h2> Tìm kiếm cùng bộ lọc </h2>
                        </div>
                        <div>
                            <label> Giá từ </label>
                            <input type="text" name="" id="from-price"> <label> đến </label>
                            <input type="text" name="" id="to-price">
                        </div>
                        <div>
                            <label> Kiểu dáng </label> <br>
                            <?php
                            if ($conn) {
                                $sql = "SELECT * FROM kieudang";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($query)) {
                                    echo '<input type="checkbox" class="shape-filter" value="' . $row['ma'] . '">' . $row['ten'];
                                }
                            }
                            ?>
                        </div>
                        <div>
                            <label> Chất liệu </label> <br>
                            <?php
                            if ($conn) {
                                $sql = "SELECT * FROM chatlieusp";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($query)) {
                                    echo '<input type="checkbox" class="material-filter" value="' . $row['ma'] . '">' . $row['ten'];
                                }
                            }
                            ?>
                        </div>
                        <div>
                            <label> Giới tính </label> <br>
                            <?php
                            if ($conn) {
                                $sql = "SELECT * FROM doituongsd";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($query)) {
                                    echo '<input type="checkbox" class="sex-filter" value="' . $row['ma'] . '">' . $row['ten'];
                                }
                            }
                            ?>
                        </div>
                        <div>
                            <button type="submit" id="show-filter-product" onclick="hehehe()"> Xem kết quả </button>
                        </div>
                    </div>



                </div>
                <script>
                    // Tìm kiếm sản phẩm -----------------------------------------------------------------
                    function timKiemSanPham() {
                        var input = document.getElementById('search-box');
                        var inputValue = input.value.toLowerCase();
                        console.log(inputValue);
                        loadData('', inputValue);
                    }

                    function hehehe() {
                        var input = document.getElementById('search-box');
                        var inputValue = input.value.toLowerCase();
                        var kieudang = [];
                        var chatlieu = [];
                        var dtsd = [];
                        var lockieudang = document.querySelectorAll('input[type="checkbox"].shape-filter');
                        lockieudang.forEach(function(checkbox) {
                            if (checkbox.checked) {
                                kieudang.push(checkbox.value);
                            }
                        });
                        console.log(kieudang);

                        var locchatlieu = document.querySelectorAll('input[type="checkbox"].material-filter');
                        locchatlieu.forEach(function(checkbox) {
                            if (checkbox.checked) {
                                chatlieu.push(checkbox.value);
                            }
                        });
                        console.log(chatlieu);

                        var locgioitinh = document.querySelectorAll('input[type="checkbox"].sex-filter');
                        locgioitinh.forEach(function(checkbox) {
                            if (checkbox.checked) {
                                dtsd.push(checkbox.value);
                            }
                        });
                        console.log(dtsd);
                        timKiemNangCao('', '', kieudang, chatlieu, dtsd);
                    }

                    function timKiemNangCao($sortby, $name, $shape, $material, $sex) {
                        // Đổi mảng checkbox sang mảng số nguyên
                        var shape = $shape.map(function(ele) {
                            return parseInt(ele);
                        });
                        var material = $material.map(function(ele) {
                            return parseInt(ele);
                        });
                        var sex = $sex.map(function(ele) {
                            return parseInt(ele);
                        });
                        $.ajax({
                            url: 'listtimkiemnangcao.php',
                            type: 'GET',
                            data: {
                                type: $sortby,
                                name: $name,
                                shape: $shape,
                                material: $material,
                                sex: $sex
                            },
                            success: function(data) {
                                console.log(data);
                            }
                        })
                    }
                </script>


            </div>


        </div>
    </div>
    <!-- -------------------------slideshow-------------------------------- -->
    <section>
        <div class="slider">
            <div class="slide-show">
                <?php
                $dir = "images/slider/";
                $scan_dir = scandir($dir);
                foreach ($scan_dir as $img) :
                    if (in_array($img, array('.', '..')))
                        continue;
                ?>
                    <img src="<?php echo $dir . $img ?>" alt="<?php echo $img ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </section>



    <section>
        <div class="sort-product-menu-bar">
            <div class="sort-product">
                <span> Xem sản phẩm theo </span>
                <button class="sort-product-checkbox" id="lowtohigh" onclick="loadData('sanPhamTheoGiaTang')"> Giá tăng dần </button>
                <button class="sort-product-checkbox" id="hightolow" onclick="loadData('sanPhamTheoGiaGiam')"> Giá giảm dần </button>
                <button class="sort-product-checkbox" id="normal" onclick="loadData('')"> Ban đầu </button>

            </div>




        </div>

    </section>


    <section>
        <div id="show-product-container">
            <div class="show-product">
                <div id="list-product">

                </div>
            </div>
            <div id="product-detail">
                <!-- <div class="close-product-detail">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <div class="detail-content">
                    <div class="detail-content-left">
                        <img src="http://localhost:100/web2/DoAnWeb2/images/product/AF2012N-4S_11zon.png" alt="">
                        <button class="add-to-cart" id=""> Thêm vào giỏ hàng </button>
                    </div>
                    <div class="detail-content-right">
                        <div style="font-size: 27px;"> Chi tiết sản phẩm </div>
                        Sản phẩm: AIR FIT AF2012N-4S <br>
                        Kiểu dáng: Vuông/Chữ nhật<br>
                        Chất liệu: Nhựa dẻo<br>
                        Dành cho: Men <br>
                        <div style="font-size: 35px; color:#353535;"> 2.500.000đ </div>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="pagination-bar">

        </div>
        <script>
            $(document).ready(function() {
                loadData('', ''); // trang đầu ko cần sort sản phẩm
                // loadData('sanPhamTheoGiaTang');   
                // loadData('sanPhamTheoGiaGiam');  

            });

            function loadData($sortby, $name) {
                $.ajax({
                    url: 'listtimkiem.php',
                    type: 'GET',
                    data: {
                        type: $sortby,
                        name: $name
                    },
                    success: function(data) {
                        divListProduct = document.getElementById('list-product');
                        if (data.length === 0) {
                            divListProduct.innerHTML = "";
                            divListProduct.innerHTML = `
                            <div class="not-found">
                                <h3> Không tìm thấy sản phẩm</h3>
                            </div>    
                            `;
                            // console.log(data);
                        } else {
                            hienThiTrangSanPham(1, data, 16);
                            doiMauNutPhanTrang(1);
                        }

                    }
                });
            }





            // Hiển thị 1 trang sản phẩm--------------------------------------------
            function hienThiTrangSanPham(viTri, list, soSanPham1Trang) {
                $("#list-product div.product-item").remove();
                var soTrang = Math.ceil(list.length / soSanPham1Trang);
                var start = (viTri - 1) * soSanPham1Trang;
                var divListProduct = document.getElementById('list-product');
                divListProduct.innerHTML = "";

                if (soTrang > 1) {
                    if (viTri === soTrang) {
                        var soSpConThieu = list.length % soSanPham1Trang;
                        // số sp còn thiếu để lấp đầy trang 
                        end = start + (soSanPham1Trang - soSpConThieu);
                        for (var i = start; i < end; i++) {
                            taoDivSanPham(list[i], divListProduct);
                        }
                        for (var i = 0; i < soSpConThieu; i++) {
                            taoDivSanPhamAo(divListProduct);
                            // tạo div sản phẩm ảo để lấp đầy trang
                        }
                    } else {
                        var end = start + soSanPham1Trang;
                        for (var i = start; i < end; i++) {
                            taoDivSanPham(list[i], divListProduct);
                        }
                    }
                } else { // length < số sản phẩm 1 trang 
                    var end = list.length;
                    for (var i = start; i < end; i++) {
                        taoDivSanPham(list[i], divListProduct);
                    }
                    if (end < soSanPham1Trang) {
                        for (var i = 0; i < soSanPham1Trang - end; i++) {
                            taoDivSanPhamAo(divListProduct);
                        }
                    }
                }



                themThanhPhanTrang(viTri, list, soSanPham1Trang);
                onclickPhanTrang(list, soSanPham1Trang);
                document.getElementById("show-product-container").scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            function themThanhPhanTrang(viTri, list, soSanPham1Trang) {
                var soTrang = Math.ceil(list.length / soSanPham1Trang);
                var divPhanTrang = document.getElementsByClassName('pagination-bar')[0];
                divPhanTrang.innerHTML = "";
                if (soTrang > 1) {
                    for (var i = 1; i <= soTrang; i++) {
                        divPhanTrang.innerHTML += `<button class="page-item" id="page` + i + `">` + i + `</button>`;
                    }
                }
            }
            // Phân trang------------------------------------------------------
            function onclickPhanTrang(list, soSanPham1Trang) {
                var page_item = document.getElementsByClassName('page-item');
                for (var i = 0; i < page_item.length; i++) {
                    (function(page_num) {
                        page_item[i].onclick = function() {
                            console.log(page_num);
                            hienThiTrangSanPham(page_num, list, soSanPham1Trang);
                            doiMauNutPhanTrang(page_num);
                        };
                    })(parseInt(page_item[i].id.substr(page_item[i].id.length - 1)));
                }
            }

            function formatPrice(dongia) {
                var dongia = dongia.toString();
                var ketqua = '';
                for (var i = dongia.length - 1; i >= 0; i--) {
                    ketqua = dongia[i] + ketqua;
                    if ((dongia.length - i) % 3 === 0 && i != 0) {
                        ketqua = '.' + ketqua;
                    }
                }
                return ketqua + '₫';
            }

            function taoDivSanPham(p, divListProduct) {
                tenSP = JSON.stringify(p.tenSP);
                img = JSON.stringify(p.img_src);
                img = img.replace(/"/g, '');
                dongia = parseInt(p.dongia);
                maSP = parseInt(p.maSP);
                var newDiv = `
    <div class="product-item"> 
        <img src="images/product/` + img + `_11zon.png">
        <div class="product-item-info">
            <div class="product-item-name">` + p.tenSP + ` </div>
            <div class="product-item-price">` + formatPrice(dongia) + `</div>
            <div class="product-detail-button">
                <button id="` + maSP + `" onclick = "chiTietSanPham(` + maSP + `)"> Xem chi tiết </button>
            </div>
        </div>  
    </div>     `
                divListProduct.innerHTML += newDiv;
            }

            function taoDivSanPhamAo(divListProduct) {
                var newDiv = `
    <div class="empty-product-item"> 
    </div>`
                divListProduct.innerHTML += newDiv;
                // sản phẩm ảo để lấp đầy trang
            }
            // Đổi màu nút phân trang khi click-----------------------------------------
            function doiMauNutPhanTrang(page_num) {
                var pagi_buttons = document.getElementsByClassName('page-item');
                for (var i = 0; i < pagi_buttons.length; i++) {
                    var btn = pagi_buttons[i];
                    if (btn.id === 'page' + page_num) {
                        btn.style.color = '#e0e0e0';
                        btn.style.backgroundColor = '#494949';
                    } else {
                        btn.style.color = '#494949';
                        btn.style.backgroundColor = '#e0e0e0';
                    }
                }
            }
            // Hiển thị chi tiết sản phẩm -----------------------------------------------------
            function chiTietSanPham(id) {
                $.ajax({
                    url: 'chitietsanpham.php',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(chiTietSanPham) {
                        console.log(chiTietSanPham);
                        taoDivChiTiet(chiTietSanPham);
                        document.getElementById('product-detail').style.display = 'flex';
                    }
                });
            }

            function taoDivChiTiet(ctsp) {
                var divChiTiet = document.getElementById('product-detail');
                divChiTiet.innerHTML = "";
                divChiTiet.innerHTML += `
                <button class="close-product-detail" onclick="dongChiTiet()">
                    <i class="fa-solid fa-circle-xmark " ></i>
                </button>
                <div class="detail-content">
                    <div class="detail-content-left">
                    <img src="images/product/` + ctsp.img + `_11zon.png">
                        <button class="add-to-cart" id=""> Thêm vào giỏ hàng </button>
                    </div>
                    <div class="detail-content-right">
                        <div style="font-size: 27px;"> Chi tiết sản phẩm </div>
                        Sản phẩm: ` + ctsp.tenSP + ` <br>
                        Kiểu dáng: ` + ctsp.kieuDang + `<br>
                        Chất liệu: ` + ctsp.chatLieu + `<br>
                        Dành cho: ` + ctsp.doiTuongSD + ` <br>
                        <div style="font-size: 35px; color:#353535;"> ` + formatPrice(ctsp.donGia) + `</div>
                    </div>
                </div>`
            }

            function dongChiTiet() {
                document.getElementById('product-detail').style.display = 'none';
            }
        </script>

    </section>

    <footer class="footer">
        <div class="footer-box1">
            <ul class="footer-item">
                <li> Lorem ipsum dolor sit amet </li>
                <li> Lorem ipsum dolor sit amet </li>
                <li> Lorem ipsum dolor sit amet </li>
                <li> Lorem ipsum dolor sit amet </li>
            </ul>
            <ul class="footer-item">
                <li> Lorem ipsum dolor sit amet </li>
                <li> Lorem ipsum dolor sit amet </li>
                <li> Lorem ipsum dolor sit amet </li>sss
                <li> Lorem ipsum dolor sit amet </li>
            </ul>
            <ul class="footer-item">
                <li> Lorem ipsum dolor sit amet </li>
                <li> Lorem ipsum dolor sit amet </li>
                <li> Lorem ipsum dolor sit amet </li>
                <li> Lorem ipsum dolor sit amet </li>
            </ul>
            <ul class="footer-item">
                <li> Lorem ipsum dolor sit amet </li>
                <li> Lorem ipsum dolor sit amet </li>
                <li> Lorem ipsum dolor sit amet </li>
                <li> Lorem ipsum dolor sit amet </li>
            </ul>
        </div>
        <div class="footer-box2">
            <div class="footer-logo"> LOGO </div>
            <div class="contact-icon"> icon </div>
        </div>

    </footer>


</body>

</html>