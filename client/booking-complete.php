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


    if($_POST){
        if(isset($_POST["booknow"])){
            $bookingnum=$_POST["bookingnum"];
            $scheduleid=$_POST["scheduleid"];
            $date=$_POST["date"];
            $scheduleid=$_POST["scheduleid"];
            $sql2="insert into booking(clientid,bookingnum,scheduleid,appodate) values ($userid,$bookingnum,$scheduleid,'$date')";
            $result= $database->query($sql2);
            //echo $apponom;
            header("location: appointment.php?action=booking-added&id=".$bookingnum."&titleget=none");

        }
    }
 ?>