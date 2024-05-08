<?php 
session_start();

// Include database connection file 
include_once 'dbConnect.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$amount = $_POST['amount'];
$comment = '';
if(isset($_POST['comment'])){
    $comment = $_POST['comment'];
}
$status = "pending";

$insert = $db->query("INSERT INTO users(name, phone, email,amount,status,comment) VALUES('".$name."','".$phone."','".$email."','".$amount."','".$status."','".$comment."')");
$last_id = $db->insert_id;

$_SESSION['user_id'] = $last_id;
