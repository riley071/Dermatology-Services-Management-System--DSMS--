<?php 
session_start();
include_once 'config.php'; 
include_once 'dbConnect.php';
error_reporting(0);

$pid = $_SESSION['user_id']; 
 
if(isset($_GET['PayerID'])){ 
    echo "<h1>Your Payment has been successfull</h1>";
    $insert = $db->query("UPDATE users SET status='completed' where id='".$pid."'");
}
else{
    echo "<h1>Your Payment has been failed</h1>";
}
session_destroy();
?>
<a href="index.php">Back to Home</a>