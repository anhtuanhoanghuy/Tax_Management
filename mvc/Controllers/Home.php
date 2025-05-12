<?php
//Trang chủ
    require_once("./mvc/core/App.php");
    require_once("./mvc/core/JWT.php");
    class Home extends Controller {
        public static function showMainPage() {
            $show = parent :: view("MainPage", 
            ["Page" => "HomePage"]);
        }

        public static function getTaxInfo() {
            $username = parent::verifyRequest(); 
            $MST = $_POST['MST'];
            $tax_type = $_POST['tax_type'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $result = $_POST['result'];
            $query = parent :: model("StatisticsModel");
    
            // StatisticsModel
            if ($tax_type == "sold") {
                $kq = $query -> getTaxInfoBySold($MST,$start_date,$end_date);
            } else if ($tax_type == "purchase") {
                $kq = $query -> getTaxInfoByPurchase($MST,$start_date,$end_date,$result);
            }
            echo json_encode($kq);
            
        }          


        public static function getCompanyInfo() {
            $username = parent::verifyRequest(); 
            $query = parent :: model("CompanyManagementModel");
            $kq = $query -> getCompanyList($username);
            echo json_encode($kq);
        }          
        
       
    }
?>