<?php 
include('includes/header.php');

?>
        
    <?php

    //learn from w3schools.com

    session_start();

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

    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-home " >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Home</p></a></div></a>
                    </td>
                </tr>
               
                   <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu"><div><p class="menu-text">All Dermatologist</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-treatment">
                        <a href="treatment.php" class="non-style-link-menu"><div><p class="menu-text">My Treatment</p></a></div>
                    </td>
                </tr>
                <!-- <tr class="menu-row" >
                    <td class="menu-btn menu-icon-counselling">
                        <a href="Questionnaire.php" class="non-style-link-menu"><div><p class="menu-text">Counselling</p></a></div>
                    </td>
                </tr> -->
                
                
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Available Schedules</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Bookings</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings  menu-icon-settings ">
                        <a href="settings.php" class="non-style-link-menu  non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                        <td width="13%" >
                    <a href="settings.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Payment</p>
                                           
                    </td>
                    
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Today's Date
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    
                                </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
        
        
                        </tr>
                <tr>

                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Appointment Payment</p>
                    </td>
                    
                </tr>
                    <td colspan="4">
                        
                        <center>
                        <?php 
// Include configuration file 
include_once 'config.php'; 
 
// Include database connection file 
include_once 'dbConnect.php'; 
?>

<!-- patient payment form -->
 <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="90%" class="sub-table scrolldown add-doc-form-container" border="0">
                       
                        <tr>
                                <td class="label-td" colspan="2">
                                     <form action="<?php echo PAYPAL_URL; ?>" method="post" id="paypal_form" onSubmit="return validateForm();">
            <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
            <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
            </td>
                            </tr>

       
            
                            <tr>
                                <td class="label-td" colspan="2">
                <div style=" margin-left: 0; ">Name<span style="color: red;"> *</span><br/>
                    <input type="text" id="name" name="name" class="input-text" class="form-control" required/>
                </div></td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
            <div style="padding-bottom: 18px;">Phone<span style="color: red;"> *</span><br/>
                <input type="text" name="phone" class="input-text"" class="form-control" required/>
            </div>
</td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">

            <div style="padding-bottom: 18px;">Email<span style="color: red;"> *</span><br/>
                <input type="text" id="email" name="email" class="input-text" required class="form-control"/>
            </div>
            </td>
                            </tr>
            <tr>
                                <td class="label-td" colspan="2">

            <div style="padding-bottom: 18px;">Appointment  Amount<span style="color: red;"> *</span><br/>
                <span><input type="radio" id="data_5_0" name="amount" hidden value="50"/></span><br/>
                <span><input type="radio" id="data_5_1" name="amount" value="100"/> k100,000.00</span><br/>
                <span><input type="radio" id="data_5_2" name="amount" hidden value="250"/></span><br/>
                <span><input type="radio" id="data_5_3" name="amount" hidden value="500"/> </span><br/>
            </div>
            </td>
                            </tr>
            <tr>
            <td class="label-td" colspan="2">
            <div style="padding-bottom: 18px;">Comment<br/>
                <textarea id="data_6" false name="comment" style="max-width : 550px;" rows="3" class="input-text"></textarea>
            </div>
            </td>
                            </tr>
            <!-- Specify a Buy Now button. -->
            <input type="hidden" name="cmd" value="_xclick">
            <!-- Specify URLs -->
            <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
            <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
            <tr>
                                <td class="label-td" colspan="2">
            <div style="padding-bottom: 18px;"><input name="skip_Submit" value="Submit" type="submit"/></div>
            </td>
                            </tr>
        </form>
        </table>
                        </div>
                        </div>
    </div>

        <script type="text/javascript">
            function validateForm() {
                if (!validateEmail(document.getElementById('email').value.trim())) {
                    alert('Email must be a valid email address!');
                    return false;
                }
                if (!document.getElementById('data_5_0').checked && !document.getElementById('data_5_1').checked && !document.getElementById('data_5_2').checked && !document.getElementById('data_5_3').checked ) {
                    alert('Donation Amount is required!');
                    return false;
                }
                submitData();
                return true;
            }
            function isEmpty(str) { return (str.length === 0 || !str.trim()); }
            function validateEmail(email) {
                var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;
                return isEmpty(email) || re.test(email);
            }
            function submitData()
            {
                var formData = $('#paypal_form').serialize();
                $.ajax({
                    url:"insertpaymentData.php",
                    type:"POST",
                    data:formData
                });
            }
        </script>

        </div>
    </div>
    
</body>
</html>