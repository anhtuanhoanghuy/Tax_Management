<?php
session_start();
    if( isset($_SESSION['account'])) {
        require_once ("./mvc/core/App.php");
        $myApp = new App();
    } else {
        require("./mvc/Views/Login.php");
    }
?>