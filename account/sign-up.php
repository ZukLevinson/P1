<?php

include '../../home/functions.php';
$conn = OpenCon();

ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);

//pull form fields into php variables
$user = $_POST['user'];
$emil = $_POST['emil'];
$pass_raw = $_POST['pass'];
$pass_encrypted = hash('sha256', $pass_raw);

$sql = "INSERT INTO users (Username, Password, Email) VALUES ('$user', '$pass_encrypted', '$emil')";

ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);

if (mysqli_query($conn, $sql)) {
    $posting = TRUE; //Worked
    echo "<a>YES</a>";
} else {
    $posting = FALSE; //Reason lies within mysqli_error($conn)
    echo "<a>NO: ". mysqli_error($conn) ."</a>";
    echo "<a>". $pass_encrypted ."</a>";
}

//close to sql
CloseCon($conn);