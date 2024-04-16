<?php
// Kiểm tra xem người dùng đã gửi thông tin đăng kí chưa
function signIn(){
    
}
function signUp(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Kết nối đến cơ sở dữ liệu
        include_once "dbconnect.php";
        
        // Lấy dữ liệu từ biểu mẫu
        $hoten = $_POST["hoten"];
        $dienthoai = $_POST["dienthoai"];
        $diachi = $_POST["diachi"];
        $email = $_POST["email"];
        $tendangnhap = $_POST["tendangnhap"];
        $pass = $_POST["pass"];
        $repass = $_POST["repass"];

        // Kiểm tra mật khẩu và mật khẩu nhập lại có khớp nhau không
        if ($pass != $repass) {
            echo "Mật khẩu và mật khẩu nhập lại không khớp.";
            exit;
        }

        // Kiểm tra xem tên đăng nhập đã tồn tại chưa
        $sql_check_username = "SELECT * FROM users WHERE username = '$tendangnhap'";
        $result_check_username = mysqli_query($conn, $sql_check_username);
        if (mysqli_num_rows($result_check_username) > 0) {
            echo "Tên đăng nhập đã tồn tại.";
            exit;
        }

        // Mã hóa mật khẩu
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // Thêm người dùng vào cơ sở dữ liệu
        $sql_insert_user = "INSERT INTO users (hovaten, sodienthoai, email, diachi, username, password) VALUES ('$hoten', '$dienthoai', '$email', '$diachi', '$tendangnhap', '$hashed_password')";
        if (mysqli_query($conn, $sql_insert_user)) {
            echo "Đăng kí thành công.";
        } else {
            echo "Đã xảy ra lỗi: " . mysqli_error($conn);
        }

        // Đóng kết nối
        mysqli_close($conn);
    }
}    
?>
