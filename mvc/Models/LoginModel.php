<?php
require_once("../core/Database.php");
    class LoginModel extends Database{
        //Lấy thông tin đăng nhập
        // public function login($a, $b){
        //     $sql = "SELECT * FROM account WHERE user_name = '$a' AND pass_word ='$b'";
        //     $result = $this ->conn->prepare($sql);
        //     $result->execute();
        //     if ($result->rowCount() ==  1) {
        //         return 1;
        //     } else {
        //         return 0;
        //     }           
        //     $conn = null;
        //     exit();
        // } 

        public function checkAccountWithEmail($a, $b, $c) {
            $sql = "SELECT * FROM account WHERE user_name = ? AND pass_word = ? AND email = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a,$b,$c]);
            if ($result->rowCount() ==  1) {
                return 1;
            } else {
                return 0;
            }           
            $conn = null;
            exit();
        }

        public function checkAccountWithTel($a, $b, $c) {
            $sql = "SELECT * FROM account WHERE user_name = ? AND pass_word = ? AND tel = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$a,$b,$c]);
            if ($result->rowCount() ==  1) {
                return 1;
            } else {
                return 0;
            }           
            $conn = null;
            exit();
        }
    } 

?>