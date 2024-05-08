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
    $mail->Username = '';   
    $mail->Password = '';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('HaleSkinCare@gmail.com');

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);
    $mail->Subject ='Your Appointment Has Been Approved';
    $mail->Body = "
    <p>Dear Patient,</p>
    <p>We're pleased to inform you that your appointment has been approved. If you have any questions or need to reschedule, please contact us.</p>
    <p>Best regards,<br>Hale Skin Care</p>
";;
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