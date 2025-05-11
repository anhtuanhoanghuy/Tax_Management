<?php
//Trang chủ
    class Settings extends Controller {
        public static function showMainPage() {
            $show = parent :: view("MainPage", 
            ["Page" => "SettingsPage"]);
        }

        public static function getAccountInfo() {
            $username = $_POST['username'];
            $token = $_POST['token'];
            $query = parent :: model("AccountManagementModel");
            $kq = $query -> getAccountInfo($username, $token);
            echo json_encode($kq);
        }

        
        public static function changeAccountInfo() {
            $username = $_POST['username'];
            $token = $_POST['token'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $query = parent :: model("AccountManagementModel");
            $kq = $query -> changeAccountInfo($username, $token,$password,$email,$tel);
            echo json_encode($kq);
            
        }

        public static function getCompanyList() {
            $username = $_POST['username'];
            $token = $_POST['token'];
            $query = parent :: model("CompanyManagementModel");
            $kq = $query -> getCompanyList($username, $token);
            echo json_encode($kq);
            
        }

        public static function addCompany() {
            $username = $_POST['username'];
            $token = $_POST['token'];
            $company_name = $_POST['company_name'];
            $MST = $_POST['MST'];
            $password = $_POST['password'];
            $token = $_POST['token'];
            $query = parent :: model("CompanyManagementModel");
            $kq = $query -> addCompany($username, $token,$company_name,$MST,$password);
            echo json_encode($kq);
            
        }

        public static function changeCompanyInfo() {
            $username = $_POST['username'];
            $token = $_POST['token'];
            $old_MST = $_POST['old_MST'];
            $company_name = $_POST['company_name'];
            $MST = $_POST['MST'];
            $password = $_POST['password'];
            $query = parent :: model("CompanyManagementModel");
            $kq = $query -> changeCompanyInfo($username,$token,$old_MST,$company_name,$MST,$password);
            echo json_encode($kq);
            
        }

        public static function deleteCompany() {
            $MST = $_POST['MST'];
            $token = $_POST['token'];
            $query = parent :: model("CompanyManagementModel");
            $kq = $query -> deleteCompany($MST,$token);
            echo json_encode($kq);
        }

    }
?>