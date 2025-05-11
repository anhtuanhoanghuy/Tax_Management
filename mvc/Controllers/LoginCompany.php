<?php
require_once("../core/Controller.php");
class LoginCompany extends Controller{
    function Login(){
        //get post data
if (isset($_POST['data_company'])) {
    $data = $_POST['data_company'];
    
    session_start();
    $_SESSION[''] = 'john.doe';

    // echo 
} 
        //check
    }
}
?>