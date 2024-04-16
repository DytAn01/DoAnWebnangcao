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