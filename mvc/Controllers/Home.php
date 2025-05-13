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
        
        public static function getCaptcha() {
            $username = parent::verifyRequest();    
            // Khởi tạo cURL
            $ch = curl_init();

            // Thiết lập URL và các tùy chọn
            curl_setopt($ch, CURLOPT_URL, "https://hoadondientu.gdt.gov.vn:30000/captcha");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    
            // Thực thi và lấy kết quả
            $response = curl_exec($ch);
            $response = json_decode($response);
            echo json_encode($response);
            curl_close($ch);
        }          
      
        public static function authenticateCaptcha() {
            $username = parent::verifyRequest();    
            $data = [
                "ckey" => $_POST['ckey'],
                "cvalue" => $_POST['cvalue'],
                "password" => $_POST['password'],
                "username" => $_POST['MST']
            ];
            // Mã hóa thành JSON
            $jsonData = json_encode($data);
            // Khởi tạo cURL
            $ch = curl_init();

            // Thiết lập URL và các tùy chọn
            curl_setopt($ch, CURLOPT_URL, "https://hoadondientu.gdt.gov.vn:30000/security-taxpayer/authenticate");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   
            curl_setopt($ch, CURLOPT_POST, true); // Bắt buộc POST 
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Gửi dữ liệu JSON
            // Header bắt buộc: Content-Type JSON
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData)
            ]);
            // Thực thi và lấy kết quả
            $response = curl_exec($ch);
            $response = json_decode($response);
            echo json_encode($response);
            curl_close($ch);
        }          
    }
?>