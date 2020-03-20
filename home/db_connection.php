<?php

function OpenCon()
{
    $db_host = "192.168.1.17";
    $db_user = "root";
    $db_pass = "&jhuVig1572#";
    $db_name = "practice";

    $conn = new mysqli($db_host, $db_user, $db_pass,$db_name);// or die("Connect failed: %s\n". $conn -> error)

    if ( mysqli_connect_errno() ) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    return $conn;
}

function CloseCon($conn)
{
    $conn -> close();
}