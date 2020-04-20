<?php
    session_start();
    include '../home/functions.php';
    $conn = OpenCon();

    //pull form fields into php variables
    $user = $_POST['user'];
    $emil = $_POST['emil'];
    $pass_raw = $_POST['pass'];

    if($user != '' and $pass_raw != ''){
        $sql = "SELECT Username, Email FROM users WHERE (Username = '$user' OR Email = '$user')";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 0){
            $pass_encrypted = hash('sha256', $pass_raw);
            $sql = "INSERT INTO users (Username, Password, Email, Kind) VALUES ('$user', '$pass_encrypted', '$emil', '0')";
            mysqli_query($conn, $sql);
            $sql = "SELECT ID, Kind FROM users WHERE (Username = '$user' OR Email = '$user') AND Password = '$pass_encrypted'";

            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $_SESSION['UserId'] = $row['ID'];
            $_SESSION['UserName'] = $user;
            $_SESSION['Kind'] = $row['Kind'];

            setcookie("userID", $_SESSION['UserId']);

            header('Location: ../account/account.php?user='.$_SESSION['UserId']);
        } else {
            $_SESSION['Errors'] = 'Username or email already signed up';
            header('Location: ../account/sign.php');
        }

    } else {
        $_SESSION['Errors'] = 'Fill username and password';
        header('Location: ../account/sign.php');
    }


    //close to sql
    CloseCon($conn);