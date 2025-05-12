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
                    $token = JWT::encode($username,self::$secret_signature);
                    // ✅ Trả về token qua JSON
                    echo json_encode([
                        'status' => 1,
                        'token' => $token
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