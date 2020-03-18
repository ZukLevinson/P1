<?php

include 'db_connection.php';
$conn = OpenCon();

ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);

//pull form fields into php variables
$user = $_POST['user'];
$pass_unen = $_POST['pass'];
$pass_encr = hash('sha256', $pass_unen);

$sql = "SELECT Id FROM users WHERE (user = '$user' OR emil = '$user') AND pass = '$pass_encr'";

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)!=0){
    $_SESSION['UserId'] = mysqli_fetch_assoc($result)['Id'];
} else {
    echo "<a>NO</a>";
}

CloseCon($conn);

?>