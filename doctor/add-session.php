<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_POST){
        //import database
        include("../connection.php");
        $title=$_POST["title"];
        $pid=$_POST["pid"];
        $nop=$_POST["nop"];
        $type=$_POST["type"];
        $medication=$_POST["medication"];
        $sql="insert into treatment (pid,title,type,medication,nop) values ($pid,'$title','$type','$medication',$nop);";
        $result= $database->query($sql);
        header("location: treatment.php?action=session-added&title=$title");
        
    }


?>