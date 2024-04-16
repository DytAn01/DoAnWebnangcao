<?php
include "header.php";
include_once "dbconnect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin đăng nhập từ form
    $username = $_POST["tendangnhap"];
    $password = $_POST["pass"];

    // Tạo một đối tượng Database
    $database = new Database();

    // Lấy kết nối từ đối tượng Database
    $conn = $database->getConnection();

    // Thực hiện xác thực đăng nhập
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Đăng nhập thành công
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        header("location: index.php"); // Chuyển hướng đến trang user.php
        exit; // Kết thúc kịch bản
    } else {
        // Đăng nhập không thành công
        $login_error = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
?>
<link rel="stylesheet" href="signin.css">
<link rel="stylesheet" href="style.css">
<div class="registration-form">        
    <form action="" method="post">
            <h1>Đăng nhập</h1>
        <div class="login-group">
            <label for="tendangnhaptxt">Tên đăng nhập</label>
            <input type="text" class="text-field" placeholder="Nhập tên đăng nhập" name="tendangnhap" required>
        </div>
        <div class="login-group">
            <label for="passtxt">Mật khẩu</label>
            <input type="password" class="text-field" placeholder="Nhập mật khẩu" name="pass" required>
        </div>
        <button type="submit" class="btn">Đăng nhập</button>
        <div class="login-assist">
            <p>Bạn chưa có tài khoản? Hãy <a href="signup.php">Đăng kí ngay</a></p>
        </div>
        
</form>
</div>
<?php
include "footer.php";
?> 