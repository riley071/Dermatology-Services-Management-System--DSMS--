<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_POST){
        //import database
        include("../connection.php");
        $status=$_POST["status"];
        $apponum=$_POST["apponum"];
        $id=$_POST["appoid"];
        $sql="insert into appointment (status,apponum,appoid) values ('accpeted','$apponum','$id');";
        $result= $database->query($sql);
        header("location: appointment.php?action=session-added&status=$status");
        
    }


?>
<!-- this is the appointments code -->