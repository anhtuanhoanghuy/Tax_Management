<?php
    class LoginModel extends Database{
        //Lấy thông tin đăng nhập

        public function checkLoginAccount($username, $password) {
            $sql = "SELECT * FROM account WHERE user_name = ? AND pass_word = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$username,$password]);
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