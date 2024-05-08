<?php 
include('includes/header.php');
include('includes/sidebar.php');

?>

  <?php

    //session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from patient where pemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];


    //echo $userid;
    //echo $username;
    
    ?>

<div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="1" class="nav-bar" >
                            <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Home: Vwc</p>
                          
                            </td>
                            <td width="25%">

                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Today's Date
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Asia/Kolkata');
        
                                $today = date('Y-m-d');
                                echo $today;


                                $patientrow = $database->query("select  * from  patient;");
                                $doctorrow = $database->query("select  * from  doctor;");
                                $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                                $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


                                ?>
                                </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
        
                        
                        <table width="90%" class="sub-table scrolldown add-doc-form-container" border="0">
                       
                  
                        <tr>
                                <td class="label-td" colspan="2">
                        <form method="post" action="sendmail.php" enctype="multipart/form-data">
            <input type="email" name="email" class="input-text" placeholder="Email Id" required>
            </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
            <input type="text" name="subject" class="input-text" placeholder="Subject" required>
            </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
            <textarea c class="input-text" name="message" placeholder="Message" required></textarea>

            </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
            <input type="file" name="attachment" class="up">
            </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td" colspan="2">
            <input class="input btn" type="submit" name="send" value="Send">
            </td>
                            </tr>
        </form>
</td>

</tr>
        </form>
        </table>
                 
</div>

</body>
</html>