<?php
    session_start();
    include '../home/functions.php';
    $conn = OpenCon();

    //pull form fields into php variables
    $user = $_POST['user'];
    $emil = $_POST['emil'];
    $pass_raw = $_POST['pass'];
    $pass_encrypted = hash('sha256', $pass_raw);

    $sql = "INSERT INTO users (Username, Password, Email, Kind) VALUES ('$user', '$pass_encrypted', '$emil', '0')";

    if (mysqli_query($conn, $sql)) {
        $posting = TRUE; //Worked

        $sql = "SELECT ID, Username, Kind FROM users WHERE (Username = '$user' OR Email = '$user') AND Password = '$pass_encrypted'";

        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION['UserId'] = $row['ID'];
        $_SESSION['UserName'] = $row['Username'];
        $_SESSION['Kind'] = $row['Kind'];

        setcookie("userID", $_SESSION['UserId']);

        $userId = $_SESSION['UserId'];
        header('Location: ../account/account.php?user='.$_SESSION['UserId']);
    } else {
        $posting = FALSE;
        $_SESSION['Errors'] = mysqli_error($conn);
        header('Location: ../account/sign.php');
    }

    //close to sql
    CloseCon($conn);