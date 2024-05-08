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
        
        
                        </tr>
                <tr>
                    <td colspan="4" >
                        
                    <center>
                    <table class="filter-container doctor-header patient-head" style="border: none;width:95%" border="0" >
                    <tr>
                        <td >
                            
                            <h1>Welcome <?php echo $username  ?>.</h1>
                            <h3>Fill out Questionnaire below in order to start counselling treatment</h3>
                            <p>Please fill out this short <b>questionnaire</b> to provide some background information about you and the issues you'd like to deal with in therapy.                         
                            <br><br>
                                </p>
                                It would help us match you with the most suitable therapist for you. Your answers will also give this therapist a good starting point in getting to know you.<br><br>
                           
                            <br>
                            <br>
                        
                        <a href="?action=add-session&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="margin-left:25px;background-image: url('../img/icons/add.svg');">Fill In Questionnaire</font></button>
                        </a>
                       
                            
                        </td>
                    </tr>
                    </table>
                    
               
                </td>
                
                
                <?php
                    if($_POST){
                        //print_r($_POST);
                        $sqlpt1="";
                        if(!empty($_POST["question1"])){
                            $type=$_POST["question1"];
                            $sqlpt1=" question.question1='$question1' ";
                        }


                        $sqlpt2="";
                        if(!empty($_POST["pid"])){
                            $pid=$_POST["pid"];
                            $sqlpt2=" patient.pid=$pid ";
                        }
                        //echo $sqlpt2;
                        //echo $sqlpt1;
                        $sqlmain= "select question.qid,question.question1,patient.pname,question.question2,question.question3,question.question4,question.question6,question.question7,question.question5 from question inner join patient on treatment.pid=patient.pid ";
                        $sqllist=array($sqlpt1,$sqlpt2);
                        $sqlkeywords=array(" where "," and ");
                        $key2=0;
                        foreach($sqllist as $key){

                            if(!empty($key)){
                                $sqlmain.=$sqlkeywords[$key2].$key;
                                $key2++;
                            };
                        };
                        //echo $sqlmain;

                        
                        
                        //
                    }else{
                        $sqlmain= "select question.qid,question.question1,patient.pname,question.question2,question.question3,question.question4,question.question6,question.question7,question.question5 from question inner join patient on question.pid=patient.pid  order by question.qid desc";

                    }



                ?>
                  
                
                       
                        
                        
            </table>
        </div>
    </div>


    <?php
    

    if($_GET){
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='add-session'){

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    
                    
                        <a class="close" href="guide.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">'.
                                   ""
                                
                                .'</td>
                            </tr>

                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Fill in Questionnaire.</p><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <form action="add-session.php" method="POST" class="add-new-form">
                                    <label for="question1" class="form-label">1. How Do You Identify ?</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                 
                                <select class="input-text" name="question1" id="question1" required>
                                 <option value="" >Select</option>
                                 <option value="Straight" >Straight</option>
                                <option value="Gay">Gay</option>
                                <option value="Lesbian">Lesbian</option>
                                <option value="Bi">Bi</option>
                                <option value="Prefer not to say">Prefer not to say</option>
                               </select>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="pid" class="form-label">Add Your name </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="pid" id="" class="box" >
                                    <option value="" disabled selected hidden>Choose client Name from the list</option><br/>';
                                        
        
                                        $list11 = $database->query("select  * from  patient order by pname asc;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $sn=$row00["pname"];
                                            $id00=$row00["pid"];
                                            echo "<option value=".$id00.">$sn</option><br/>";
                                        };
        
        
        
                                        
                        echo     '       </select><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="question2" class="form-label">2. What led you to consider therapy ? </label>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select class="input-text" name="question2" id="question2" required>
                                                                    <option value="" >Select</option>
                                    <option value="I have been feeling depressed">I have been feeling depressed</option>
                                    <option value="I feel Anxious or overwhelmed">I feel Anxious or overwhelmed</option>
                                    <option value="I am grieving">Iam grieving</option>
                                    <option value="Recommended to me">Recommended to me (family,friend or doctor)</option>
                                    <option value="My mood is interfering with my school or job">My mood is interfering with my school or job</option>
                                    <option value="I am grieving">Iam grieving</option>
                                    <option value="Just Exploring">Just Exploring</option>
                                    <option value="I have experienced trauma">I have experienced trauma</option>
                                    <option value="I want to improve myself but i dont know where to start">I want to improve myself but i dont know where to start</option>
                                    <option value="I want to gain self confidence">I want to gain self confidence</option>
                                    <option value="I need to talk through a specific challenge">I need to talk through a specific challenge</option>
                                    <option value=Other">Other</option>
                                  </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="question3" class="form-label">3. What is your relationship status?</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <select class="input-text" name="question3" id="question3" required>
                                <option value="" >Select</option>
                                <option value="Married" >Married</option>
                                <option value="Single" >Single</option>
                              <option value="Divorced">Divorced</option>
                              <option value="Widowed">Widowed</option>
                              <option value=Other">Other</option>
                              <option value="Prefer not to say">Prefer not to say</option>
                              </select>
                            </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="question4" class="form-label">4. What type of therapy are you looking for ?</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <select class="input-text" name="question4" id="question4" required>
                                <option value="" >Select</option>
                                <option value="Individual (for myself)" >Individual (for myself)</option>
                                <option value="Couples (for myself and partner) ">Couples(for myself and partner)</option>
                                <option value="Teen (for my child) ">Teen (for my child)</option>
                              </select>
                                  
                                </td>
                            </tr>

                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="question6" class="form-label">5. Do You Consider yourself to be religious ?</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            <select class="input-text" name="question6" id="question6" required>
                            <option value="" >Select</option>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                          </select>
                              
                            </td>
                        </tr>



                        <tr>
                                <td class="label-td" colspan="2">
                                    <label for="question7" class="form-label">6. Have You Been In Therapy Before ?</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <select class="input-text" name="question7" id="question7" required>
                                <option value="" >Select</option>
                                <option value="No">No</option>
                                 <option value="Yes">Yes</option>
                              </select>
                                  
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="question5" class="form-label">7. How old are you ?</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="number" name="question5" class="input-text"  required><br>
                                </td>
                            </tr>
                           
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="submit" class="login-btn btn-primary btn" name="shedulesubmit">
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
            $titleget=$_GET["pid"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br>
                        <h2>Questionnaire Submitted.</h2>
                        <a class="close" href="guide.php">&times;</a>
                        <div class="content">
                        '.substr($titleget,0,40).' We know how important it is to have the right therapist who understands you. By answering questions about yourself, we ll provide you with a tailored match to a therapist who is best suited to help you..<br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        
                        <a href="guide.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                        </div>
                    </center>
            </div>
            </div>
            ';
    }
}
 

    ?>
    
  
    </div>

</body>
</html>