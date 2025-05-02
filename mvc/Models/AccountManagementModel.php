<?php
    class AccountManagementModel extends Database{
        //lấy thông tin tài khoản
        public function getAccountInfo($username,$token) {
            $sql = "SELECT email, tel FROM account WHERE account.user_name = ?";
            $result = $this ->conn->prepare($sql);
            $result->execute([$username]);
            $row = $result -> fetchAll(PDO::FETCH_ASSOC);
            return ($row);
        }

        //thay đổi thông tin tài khoản
        public function changeAccountInfo($username, $token,$password,$email,$tel) {
            $sql = "SELECT * FROM account WHERE (email = ? OR tel = ?) AND user_name != ?";
            $result = $this->conn->prepare($sql);
            $result->execute([$email, $tel, $username]);
            if ($result->rowCount() > 0) {
                return -1; // Đã có người khác dùng email hoặc tel này
            } else {
                if (!empty($password)) {
                    $sql = "UPDATE account SET pass_word = ?, email = ?, tel = ? WHERE user_name = ?";
                    $result = $this ->conn->prepare($sql);
                    $result->execute([$password, $email, $tel, $username]);
                } else {
                    $sql = "UPDATE account SET email = ?, tel = ? WHERE user_name = ?";
                    $result = $this->conn->prepare($sql);
                    $result->execute([$email, $tel, $username]);
                }
                if ($result->rowCount() > 0) { //thành công
                    return 1;
                } else {
                    return 0;
                }
            }

        } 
    }

?>