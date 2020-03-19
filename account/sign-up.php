<?php

include '../db_connection.php';
$conn = OpenCon();

ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);

//pull form fields into php variables
$user = $_POST['user'];
$emil = $_POST['emil'];
$pass_unen = $_POST['pass'];
$pass_encr = hash('sha256', $pass_unen);

$sql = "INSERT INTO users (user, pass, emil)
VALUES ('$user', '$pass_encr', '$emil')";

ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);

if (mysqli_query($conn, $sql)) {
    $posting = TRUE; //Worked
    echo "<a>YES</a>";
} else {
    $posting = FALSE; //Reason lies within mysqli_error($conn)
    echo "<a>NO: ". mysqli_error($conn) ."</a>";
    echo "<a>". $pass_encr ."</a>";
}

//close to sql
CloseCon($conn);

?>