<?php
//Đăng nhập tài khoản và lưu vào SESSION
require_once("./mvc/core/JWT.php");
class Login extends Controller {
    public static function checkLoginAccount() {       
        if (isset($_SESSION["account"])) {
            header("Location: /Tax_Management/Home");
            exit;
        } else {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = md5($_POST['password']);
                $query = parent::model("LoginModel");
                $result = $query->checkLoginAccount($username, $password);
                if ($result == 1) {
                    $_SESSION["account"] = $username;

                    // ✅ Tạo token JWT
                    $token = JWT::encode($username, self::$secret_signature);

                    // ✅ Gửi token vào cookie session (hết khi đóng trình duyệt)
                    setcookie("accessToken", $token, 0, "/", "", false, false); 
                    //            ^ expires=0  ^ path ^secure ^HttpOnly=true (không JS đọc được)
                    // ✅ Trả kết quả thành công (không gửi token nữa)
                    echo json_encode([
                        'status' => 1,
                        'message' => 'Đăng nhập thành công'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 0,
                        'message' => 'Sai tài khoản hoặc mật khẩu'
                    ]);
                }
            }
        }
    }
}
?>