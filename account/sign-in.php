<?php
    session_start();

    include_once '../home/functions.php';

    $conn = OpenCon();

    if (!isset($_SESSION['UserId'])) {
        if (isset($_POST['user']) and isset($_POST['pass'])) {
            unset($_SESSION['Errors']);

            //pull form fields into php variables
            $user = $_POST['user'];
            $password_raw = $_POST['pass'];

            if($user !='' and $password_raw !=''){
                $password_encrypted = hash('sha256', $password_raw);
                $sql = "SELECT ID, Username, Kind FROM users WHERE (Username = '$user' OR Email = '$user') AND Password = '$password_encrypted'";

                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) != 0) {
                    $row = mysqli_fetch_array($result);
                    $_SESSION['UserId'] = $row['ID'];
                    $_SESSION['UserName'] = $row['Username'];
                    $_SESSION['Kind'] = $row['Kind'];

                    setcookie("userID",$_SESSION['UserId']);

                    header('Location: ../account/account.php?user='.$_SESSION['UserId']);
                } else {
                    $_SESSION['Errors'] = "Your username or password was incorrect.";
                    header('Location: ../account/sign.php');
                }
            } else {
                $_SESSION['Errors'] = "Enter username and password";
                header('Location: ../account/sign.php');
            }

        }
    }

    CloseCon($conn);