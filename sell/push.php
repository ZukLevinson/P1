<?php
include '../home/functions.php';

session_start();
$conn = OpenCon();

//pull form fields into php variables
$name = $_POST['name'];
$dscr = $_POST['dscr'];
$pric = $_POST['pric'];
$quan = $_POST['quan'];
$catg = $_POST['catg'];
$ship = $_POST['ship'];
$image = $_FILES['image']['name'];
$target = "../images/uploads/".basename($image);

if ($ship == "No") { //Switch to the specific number
    $ship = $_POST['ship_other'];
}

if(isset($_SESSION['UserId'])) {
    $required = array('name', 'dscr', 'pric', 'quan', 'catg');
    $error = false;
    foreach($required as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['Errors_sell'] = array("Enter all fields.");
            header('Location: ../sell/sell.php');
        }
    }

    unset($_SESSION['Errors_sell']);
    $user = $_SESSION['UserId'];

    //Input into the database
    $sql = "INSERT INTO data (Item, Description, Price, Quantity, Category, Shipping, SellerID, Image) VALUES ('$name', '$dscr', '$pric', '$quan', '$catg', '$ship','$user', '$image')";
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    if (mysqli_query($conn, $sql)) {
        header('Location: ../store/store.php');
    } else {
        echo "<a>".mysqli_error($conn)."</a>";
    }
} else {
    $_SESSION['Errors_sell'] = array("Log in");
    header('Location: ../sell/sell.php');
}

//close to sql
CloseCon($conn);