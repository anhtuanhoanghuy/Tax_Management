<?php
//Trang chủ
    class Support extends Controller {
        public static function showMainPage() {
            $show = parent :: view("MainPage", 
            ["Page" => "SupportPage"]);
        }
    }
?>