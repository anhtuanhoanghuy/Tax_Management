<?php
//Đăng xuất tài khoản và xóa SESSION
session_start();
     if(isset($_SESSION['account'])) {
        unset($_SESSION['account']);
        header("location:/Tax_Management");
    }

?>