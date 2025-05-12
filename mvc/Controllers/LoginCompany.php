<?php

class LoginCompany extends Controller{
    function Login(){
        //test
        echo "ok";
        //get post data
if (isset($_POST['mst'])&& isset($_POST['token']) ) {
    $mst=$_POST["mst"];
    $token=$_POST["token"];
    //
    session_start();
    $_SESSION['Token'."_".$mst] =$mst.$token;
    setcookie('Token'."_".$mst,$mst.$token,0,"/","",TRUE,FALSE);
    header("HTTP/1.1 200 OK");} 

    }
}
?>