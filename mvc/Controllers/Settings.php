<?php
//Trang chủ
    class Settings extends Controller {
        public static function showMainPage() {
            $show = parent :: view("MainPage", 
            ["Page" => "SettingsPage"]);
        }
    }
?>