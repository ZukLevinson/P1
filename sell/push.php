<?php

include 'db_connection.php';
$conn = OpenCon();

//pull form fields into php variables
$name = $_POST['name'];
$dscr = $_POST['dscr'];
$pric = $_POST['pric'];
$quan = $_POST['quan'];
$catg = $_POST['catg'];
$ship = $_POST['ship'];

if($ship == "No"){ //Switch to the specific number
    $ship = $_POST['ship_other'];
}

 //Input into the database
$sql = "INSERT INTO data (name, dscr, pric, quan, catg, ship)
VALUES ('$name', '$dscr', '$pric', '$quan', '$catg', '$ship')";

if (mysqli_query($conn, $sql)) {
    $posting = TRUE; //Worked
} else {
    $posting = FALSE; //Reason lies within mysqli_error($conn)
}

//close to sql
CloseCon($conn);

?>