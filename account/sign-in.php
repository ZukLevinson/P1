<?php
session_start();

include '../db_connection.php';
$conn = OpenCon();

ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);

//pull form fields into php variables
$user = $_POST['user'];
$password_raw = $_POST['pass'];
$password_encrypted = hash('sha256', $password_raw);

$sql = "SELECT Id FROM users WHERE (user = '$user' OR emil = '$user') AND pass = '$password_encrypted'";

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)!=0){
    $_SESSION['UserId'] = mysqli_fetch_assoc($result)['Id'];
} else {
    echo "<a>NO</a>";
}

CloseCon($conn);