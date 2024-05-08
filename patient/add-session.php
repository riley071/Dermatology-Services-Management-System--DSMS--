<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_POST){
        //import database
        include("../connection.php");
        $question1=$_POST["question1"];
        $pid=$_POST["pid"];
        $question2=$_POST["question2"];
        $question3=$_POST["question3"];
        $question4=$_POST["question4"];
        $question6=$_POST["question6"];
        $question7=$_POST["question7"];
        $question5=$_POST["question5"];
        
        $sql="insert into question (pid,question1,question2,question3,question4,question6,question7,question5) values ($pid,'$question1','$question2','$question3','$question4','$question6','$question7',$question5);";
        $result= $database->query($sql);
        header("location: guide.php?action=session-added&title=$pid");
        
    }


?>