<?php
    class AccountManagementModel extends Database{
        //lấy thông tin tài khoản
        public function getAccountInfo($username) {
            $sql = "SELECT email, tel FROM account WHERE account.user_name = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$username]);
            $row = $result -> fetchAll(PDO::FETCH_ASSOC);
            return ($row);
        }

        //thay đổi thông tin tài khoản
        public function changeAccountInfo($username,$password) {
            $sql = "UPDATE account SET pass_word = ? WHERE user_name = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$password, $username]);
            if ($result->rowCount() > 0) { //thành công
                return 1;
            } else {
                return 0;
            }
        }

    } 
    

?>