<?php
//Đăng nhập tài khoản và lưu vào SESSION
session_start();
include ("../core/App.php");
class Login{
    //Hàm đăng nhập tài khoản sử dụng SESSION
    function __construct() {
        if (isset($_SESSION["account"])) {
            header("location:/Tax_Management/Home");
        } else {
            if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    require_once("../Models/LoginModel.php");
                    $kq = new LoginModel();
                    if (strpos($email, '@') !== false) {
                        $result = $kq -> checkAccountWithEmail($username, $password,$email);
                    } else {
                        $result = $kq -> checkAccountWithTel($username, $password,$email);
                    }
                    if($result != 0 ) {
                        $_SESSION["account"] = $result;
                        header("location:/Tax_Management/Home");
                    } else if($result == 0) {
                        header("Refresh:0;  url=/Tax_Management");
                    }
            }          
        }
         
}
}
$login = new Login();
// C9MH7RUN1Z8EQ93GUHRRSZT1
?>