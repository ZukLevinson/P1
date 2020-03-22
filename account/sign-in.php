<?php
    session_start();

    include_once '../home/functions.php';

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

                setcookie("userID",$_SESSION['UserId']);

                $userId = $_SESSION['UserId'];
                $sessionId = session_id();
                $sql = "INSERT INTO user_session (UserID, Session) VALUES ('$userId','$sessionId')";
                if (mysqli_query($conn, $sql)) {
                    $posting = TRUE; //Worked
                } else {
                    $posting = FALSE; //Reason lies within mysqli_error($conn)
                }

                header('Location: ../account/account.php?user='.$_SESSION['UserId']);
            } else {
                $_SESSION['Errors'] = array("Your username or password was incorrect.");
                header('Location: ../account/sign.php');
            }
        }
    }

    CloseCon($conn);