<?php
include "header.php";
?>
<link rel="stylesheet" href="signup.css">
<link rel="stylesheet" href="style.css">
<div class="registration-form">
        <form action="signup_process.php" method="post">
                    <h1>Đăng kí</h1>
                    <p> Chào mừng bạn đến YOU</p>
                <div class="login-group">
                    <label for="hotentxt">Tên của bạn</label>
                    <input type="text" class="text-field" placeholder="Nhập tên của bạn" name="hoten" required autofocus>
                    <span id="hotenerrortxt" class="text-danger" style="color: red; float: right; margin-bottom: 20px; display: none;">Tối thiểu 3 ký tự và tối đa 50 ký tự</span>
                </div>
                <div class="login-group">
                    <label for="dienthoaitxt">Số điện thoại</label>
                    <input type="text" class="text-field" placeholder="Nhập số điện thoại của bạn" name="dienthoai" required autofocus>
                    <span id="dienthoaierrortxt" class="text-danger" style="color: red; float: right; margin-bottom: 20px; display: none;">Số điện thoại không hợp lệ</span>

                </div>
                    <div class="login-group">
                    <label for="diachitxt">Địa chỉ</label>
                    <input type="text" class="text-field" placeholder="Nhập địa chỉ của bạn" name="diachi" required>
                    <span id="diachierrortxt" class="text-danger" style="color: red; float: right; margin-bottom: 20px; display: none;">Địa chỉ không hợp lệ</span>
                </div>
                <div class="login-group">
                    <label for="emailtxt">Email</label>
                    <input type="text" class="text-field" placeholder="Nhập email của bạn" name="email" required>
                    <span id="emailerrortxt" class="text-danger" style="color: red; float: right; margin-bottom: 20px; display: none;">Email không đúng định dạng</span>
                </div>
                <div class="login-group">
                    <label for="tendangnhaptxt">Tên đăng nhập</label>
                    <input type="text" class="text-field" placeholder="Nhập tên đăng nhập" name="tendangnhap" required>
                    <span id="usernameerrortxt" class="text-danger" style="color: red; float: right; margin-bottom: 20px; display: none;">Username KHÔNG viết dấu, khoảng cách, in hoa và ký tự đặc biệt</span>
                </div>
                <div class="login-group">
                    <label for="passtxt">Mật khẩu</label>
                    <input type="password" class="text-field" placeholder="Nhập mật khẩu" name="pass" required>
                    <span id="passerrortxt" class="text-danger" style="color: red; float: right; margin-bottom: 20px; display: none;">Mật khẩu không được có khoảng cách</span>
                </div>
                <div class="login-group">
                    <label for="repasstxt">Nhập lại mật khẩu</label>
                    <input type="password" class="text-field" placeholder="Nhập lại mật khẩu" name="repass" required>
                    <span id="passerrortxt" class="text-danger" style="color: red; float: right; margin-bottom: 20px; display: none;">Mật khẩu không khớp</span>
                </div>
                <button type="submit" class="btn">Đăng kí</button>
                <div class="login-assist">
                    <p>Bạn đã có tài khoản? <a href="signin.php">Đăng nhập</a></p>
                    
                </div>    
           
        </form>
       
</div>
<script src="js/signupandsignin.js"></script>
<?php
include "footer.php";
?>    