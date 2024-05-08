<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send"])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = '';  //add email
    $mail->Password = '';// app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('Vintagewellnesscenter@gmail.com');

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);
    $mail->Subject ='Your Video Chat Link for Your Appointment';
    $mail->Body =
    "<p>Dear Patient,</p>
        <p>We're excited to have you join your appointment via video chat with your doctor. Below is the link to access the video chat:</p>
        <p><a href>Join Video Chat</a></p>
        <p>Please click the link at the scheduled time of your appointment to start your video consultation. If you have any questions or need assistance, feel free to contact us.</p>
        <p>Best regards,<br>Vintage Wellness Center</p>";
    $mail->send();

    echo
    "
    <script>
    alert('Sent Succesfully');
    document.location=href = 'index.php';
    </script>
    ";
}




?>