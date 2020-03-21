<?php
    include_once '../home/functions.php';

    session_start();
    $conn = OpenCon();

    ini_set('display_errors', '1');
    ini_set('error_reporting', E_ALL);

    if (!isset($_SESSION['UserId'])) {
        if (isset($_POST['user']) && isset($_POST['pass'])) {
            unset($_SESSION['Errors']);

            //pull form fields into php variables
            $user = $_POST['user'];
            $password_raw = $_POST['pass'];
            $password_encrypted = hash('sha256', $password_raw);

            $sql = "SELECT ID, Username FROM users WHERE (Username = '$user' OR Email = '$user') AND Password = '$password_encrypted'";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) != 0) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $_SESSION['UserId'] = $row['ID'];
                $_SESSION['UserName'] = $row['Username'];
                header('Location: ../account/account.php?user='.$_SESSION['UserId']);
            } else {
                $_SESSION['Errors'] = array("Your username or password was incorrect.");
                header('Location: ../account/sign.php');
            }
        }
    }

    CloseCon($conn);