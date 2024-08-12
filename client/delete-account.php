<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='c'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from client where clientemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["clientid"];
    $username=$userfetch["clientname"];

    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        $result001= $database->query("select * from client where clientid=$id;");
        $email=($result001->fetch_assoc())["clientemail"];
        $sql= $database->query("delete from webuser where email='$email';");
        $sql= $database->query("delete from client where clientemail='$email';");
        //print_r($email);
        header("location: ../logout.php");
    }


?>