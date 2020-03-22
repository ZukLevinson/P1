<?php
    session_start();

    include_once ('../home/functions.php');

    $conn = OpenCon();

    if(isset($_SESSION['Cart'])){
        $total = $_POST['price'];
        $shipping = $_POST['shipping'];
        $itemsId = $_POST['cart'];
        $paid = $_POST['payment'];
        $userId = $_SESSION['UserId'];

        $conn = OpenCon();
        $sql = "INSERT INTO transactions (UserID, ItemsID, Total, Shipping, Paid) VALUES ('$userId', '$itemsId', '$total', '$shipping', '$paid')";

        if (mysqli_query($conn, $sql)) {
            unset($_SESSION['Cart']);
            header('Location: ../account/account.php?user='.$userId);
        } else {
            $_SESSION['Errors_sell'] = array(mysqli_error($conn));
            header('Location: ../store/cart.php');
        }
    } else echo"<a>Add Items To The Cart</a>";