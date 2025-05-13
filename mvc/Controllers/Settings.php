<?php
//Trang chủ
 require_once("./mvc/core/JWT.php");
    class Settings extends Controller {
        public static function showMainPage() {
            $show = parent :: view("MainPage", 
            ["Page" => "SettingsPage"]);
        }

        public static function getAccountInfo() {
            $username = parent::verifyRequest(); 
            $query = parent :: model("AccountManagementModel");
            $kq = $query -> getAccountInfo($username);
            echo json_encode($kq);
        }

        
        public static function changeAccountInfo() {
            $username = parent::verifyRequest(); 
            $password = md5($_POST['password']);
            $query = parent :: model("AccountManagementModel");
            $kq = $query -> changeAccountInfo($username,$password);
            echo json_encode($kq);
            
        }

        public static function getCompanyList() {
            $username = parent::verifyRequest(); 
            $query = parent :: model("CompanyManagementModel");
            $kq = $query -> getCompanyList($username);
            echo json_encode($kq);
            
        }

        public static function addCompany() {
            $username = parent::verifyRequest(); 
            $company_name = $_POST['company_name'];
            $MST = $_POST['MST'];
            $password = $_POST['password'];
            $query = parent :: model("CompanyManagementModel");
            $kq = $query -> addCompany($username,$company_name,$MST,$password);
            echo json_encode($kq);
            
        }

        public static function changeCompanyInfo() {
            $username = parent::verifyRequest(); 
            $old_MST = $_POST['old_MST'];
            $company_name = $_POST['company_name'];
            $MST = $_POST['MST'];
            $password = $_POST['password'];
            $query = parent :: model("CompanyManagementModel");
            $kq = $query -> changeCompanyInfo($username,$old_MST,$company_name,$MST,$password);
            echo json_encode($kq);
            
        }

        public static function deleteCompany() {
            $username = parent::verifyRequest(); 
            $MST = $_POST['MST'];
            $query = parent :: model("CompanyManagementModel");
            $kq = $query -> deleteCompany($MST);
            echo json_encode($kq);
        }

    }
?>