<?php

function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "admin";
    $dbpass = "&jhuVig1572#";
    $db = "practice";

    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);// or die("Connect failed: %s\n". $conn -> error)

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

?>