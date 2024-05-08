<?php include('includes/header.php'); 
?>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="appointment.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Appointment Manager</p>
                                           
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

                        $list110 = $database->query("select  * from  appointment;");

                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Appointments (<?php echo $list110->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;" >
                        <center>
                        <table class="filter-container" border="0" >
                        <tr>
                           <td width="10%">

                           </td> 
                        <td width="5%" style="text-align: center;">
                        Date:
                        </td>
                        <td width="30%">
                        <form action="" method="post">
                            
                            <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                        </td>
                        <td width="5%" style="text-align: center;">
                        Doctor:
                        </td>
                        <td width="30%">
                        <select name="docid" id="" class="box filter-container-items" style="width:90% ;height: 37px;margin: 0;" >
                            <option value="" disabled selected hidden>Choose Doctor Name from the list</option><br/>
                                
                            <?php 
                             
                                $list11 = $database->query("select  * from  doctor order by docname asc;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $sn=$row00["docname"];
                                    $id00=$row00["docid"];
                                    echo "<option value=".$id00.">$sn</option><br/>";
                                };


                                ?>

                        </select>
                    </td>
                    <td width="12%">
                        <input type="submit"  name="filter" value=" Filter" class=" btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>

                    </tr>
                            </table>

                        </center>
                    </td>
                    
                </tr>
                
                <?php
                    if($_POST){
                        //print_r($_POST);
                        $sqlpt1="";
                        if(!empty($_POST["sheduledate"])){
                            $sheduledate=$_POST["sheduledate"];
                            $sqlpt1=" schedule.scheduledate='$sheduledate' ";
                        }


                        $sqlpt2="";
                        if(!empty($_POST["docid"])){
                            $docid=$_POST["docid"];
                            $sqlpt2=" doctor.docid=$docid ";
                        }
                        
                        $sqlmain= "select appointment.appoid,appointment.status,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,patient.pemail,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid";
                        $sqllist=array($sqlpt1,$sqlpt2);
                        $sqlkeywords=array(" where "," and ");
                        $key2=0;
                        foreach($sqllist as $key){

                            if(!empty($key)){
                                $sqlmain.=$sqlkeywords[$key2].$key;
                                $key2++;
                            };
                        };
                       

                        
                        
                        //
                    }else{
                        $sqlmain= "select appointment.appoid,appointment.status,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,patient.pemail,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  order by schedule.scheduledate desc";

                    }



                ?>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    Patient name
                                </th>
                                <th class="table-headin">
                                    
                                    Appointment number
                                    
                                </th>
                               
                                
                                <th class="table-headin">
                                    Doctor
                                </th>
                                <th class="table-headin">
                                    
                                
                                    Session Title
                                    
                                    </th>
                                
                                <th class="table-headin" style="font-size:10px">
                                    
                                    Session Date & Time
                                    
                                </th>

                                
                                <th class="table-headin">
                                    
                                    Appointment Date
                                    
                                </th>
                                
                                <th class="table-headin">
                                    
                                    Events
                                    
                                </tr>
                                
                        </thead>
                        <tbody>
                        
                            <?php

                                
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointments &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $appoid=$row["appoid"];
                                    $scheduleid=$row["scheduleid"];
                                    $title=$row["title"];
                                    $pemail=$row["pemail"];
                                    $docname=$row["docname"];
                                    $scheduledate=$row["scheduledate"];
                                    $scheduletime=$row["scheduletime"];
                                    $status=$row["status"];
                                    $pname=$row["pname"];
                                    $apponum=$row["apponum"];
                                    $appodate=$row["appodate"];
                                    echo '<tr >
                                        <td style="font-weight:600;"> &nbsp;'.
                                        
                                        substr($pname,0,25)
                                        .'</td >
                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                        '.$apponum.'
                                        
                                        </td>
                                        <td>
                                        '.substr($docname,0,25).'
                                        </td>
                                        <td style="text-align:center;">
                                        '.substr($title,0,15).'
                                        </td>
                                        <td style="text-align:center;font-size:12px;">
                                            '.substr($scheduledate,0,10).' <br>'.substr($scheduletime,0,5).'
                                        </td>
                                        
                                        <td style="text-align:center;">
                                            '.$appodate.'
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id='.$appoid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-not"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Notify</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id='.$appoid.'&name='.$pname.'&session='.$title.'&apponum='.$apponum.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-bin"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 10px;margin-top: 10px;"><font class="tn-in-text">Cancel</font>  </br></button></a>&nbsp;&nbsp;
                                       &nbsp;&nbsp;&nbsp;
                                   </div>
                                        </td>
                                    </tr>';
                                    
                                }
                            }
                                 
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>          
            </table>
        </div>
    </div>
    <?php
    
    if($_GET){
        $id=$_GET["id"];
        $action=$_GET["action"];
        $apponum=$_GET["apponum"];
        $pname=$_GET["name"];
        $status=$_GET["status"];

         if($action=='add-session'){
           
            echo '
            <div id="popup1" class="overlay" >
                    <div class="popup" >
                    <center>
                    
                    
                        <a class="close" href="appointment.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="90%" class="sub-table scrolldown add-doc-form-container" border="0">
                          <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Change appointment status.</p><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <form action="add-appo.php" method="POST" class="add-new-form">
                                    <label for=" " class="form-label">Session Title :  '.$id.'</label>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                <label for=" " class="form-label">Appointment no :  '.$apponum.'</label><br>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="" class="form-label">Client name: '.$pname.'</label>
                                </td>
                            </tr>
                            <tr>
                                
                            <td class="label-td" colspan="2">
                                <label for="status" class="form-label" >Current  Status: '.$status.'</label>
                            </td>
                        </tr>
                        <tr>
                                <td class="label-td" colspan="2">
                                    <input type="status" name="status" class="input-text" value="Accepted" required><br>
                                    
                                </td>
                            </tr>
                           
                            <tr>
                                <td colspan="2">
                                <input type="submit" value="ADD" class="login-btn btn-primary btn" name="shedulesubmit">
                                </td>
                
                            </tr>
                           
                            </form>
                            </tr>
                        </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
       
        }elseif($action=='session-added'){
            $statusget=$_GET["status"];
            echo '  
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br>
                        <h2>Appointment Accepted</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                        '.substr($statusget,0,40).' was accepted.<br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($action=='drop'){
            $nameget=$_GET["name"];
            $session=$_GET["session"];
            $apponum=$_GET["apponum"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br><br>
                            Patient Name: &nbsp;<b>'.substr($nameget,0,40).'</b><br>
                            Appointment number &nbsp; : <b>'.substr($apponum,0,40).'</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-appointment.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            '; 
            
        }elseif($action=='view'){
            $sqlmain= "select appointment.appoid,appointment.apponum,patient.pname,patient.pemail from appointment inner join patient on appointment.pid=patient.pid  where  appointment.appoid=$id";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $pname=$row["pname"];
            $pemail=$row["pemail"];
            $appoid=$row["appoid"];
            $apponum=$row["apponum"];
           
            
           
          
            $sqlmain12= "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.scheduleid=$id;";
            $result12= $database->query($sqlmain12);
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup" style="width: 50%;">
                    <center>
                        <h2></h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            
                            
                        <div class=""> 
                        <div class="form-body">
                        <h1>Appointment Notification</h1>
                        <table border="0" style="margin: 0;padding: 0;width: 70%;">     
                        <form class="" action="emailappointmentsend.php" method="post">
                        <tr>
                <td class="label-td" style="margin: 12%;">
                Client Email  <input type="email" name="email" class="input-text"     value="'.$pemail.'"><br>
                        </td>
                        </tr>


                        <tr>
                 <tr>
                        <td class="label-td" style="margin: 12%;"> Message 
                       <input type="text" class="input-text" name="message" value="Dear Sir/Madam we would like to inform you that youre appointment has been approved, Please make sure to check with your dermatologist!!!"><br> 
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <button class="login-btn btn-primary btn" type="submit" name="send">Accepted</button>
                        </td>
                        </tr>

                </form> 
                </table>
                </div>
                </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';  
    }
}

    ?>
    </div>

    

</body>
</html>