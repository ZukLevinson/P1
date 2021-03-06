<?php
    function OpenCon()
    {
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "se>5pgDPkt1z";
        $db_name = "practice";

        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);// or die("Connect failed: %s\n". $conn -> error)

        if (mysqli_connect_errno()) {
            // If there is an error with the connection, stop the script and display the error.
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        return $conn;
    }

    function CloseCon($conn)
    {
        $conn->close();
    }

    function template_header($title)
    {
        if (isset($_SESSION['UserId'])) {
            $username = $_SESSION['UserName'];
            $userId = $_SESSION['UserId'];
            $kind = $_SESSION['Kind'] == '1' ? '(Admin)' : '';
        } else {
            $username = 'LOGIN';
            $userId = '';
            $kind = '';
        }

        if (isset($_SESSION['Cart'])) {
            $cart_status = count($_SESSION['Cart']);
        } else {
            $cart_status = "CART";
        }
        echo <<<EOT
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <title>$title | ElectroStore</title>
                    <link rel="stylesheet" type="text/css" href="../home/styles.css">
                </head>
                <body>
                    <div class="header">
                        <div class="links left">
                            <a href="../home/index.php">HOME</a>
                            <a href="../store/store.php">STORE</a>
                        </div>
                        <div class="logos" onclick="window.location.href='../home/index.php'">
                            <svg fill="rgb(236, 236, 236)" height="416pt" viewBox="0 -2 416 416" width="416pt" xmlns="http://www.w3.org/2000/svg">
                                <path id="logo1" d="m406 141.847656c5.523438 0 10-4.480468 10-10 0-5.523437-4.476562-10-10-10h-46.570312v-13.8125c-.03125-28.410156-23.054688-51.433594-51.464844-51.464844h-13.8125v-46.570312c0-5.523438-4.476563-10-10-10-5.519532 0-10 4.476562-10 10v46.570312h-27.867188v-46.570312c0-5.523438-4.476562-10-10-10-5.523437 0-10 4.476562-10 10v46.570312h-32.21875v-46.570312c0-5.523438-4.476562-10-10-10-5.523437 0-10 4.476562-10 10v46.570312h-32.222656v-46.570312c0-5.523438-4.476562-10-10-10s-10 4.476562-10 10v46.570312h-9.457031c-28.410157.03125-51.433594 23.054688-51.464844 51.464844v13.8125h-50.921875c-5.523438 0-10 4.476563-10 10 0 5.519532 4.476562 10 10 10h50.921875v27.867188h-50.921875c-5.523438 0-10 4.476562-10 10 0 5.523437 4.476562 10 10 10h50.921875v32.21875h-50.921875c-5.523438 0-10 4.476562-10 10 0 5.523437 4.476562 10 10 10h50.921875v32.21875h-50.921875c-5.523438 0-10 4.480468-10 10 0 5.523437 4.476562 10 10 10h50.921875v9.457031c.035156 28.410156 23.058594 51.433594 51.46875 51.46875h9.457031v46.921875c0 5.523438 4.476563 10 10 10 5.519532 0 10-4.476562 10-10v-46.921875h32.21875v46.921875c0 5.523438 4.476563 10 10 10 5.523438 0 10-4.476562 10-10v-46.921875h32.21875v46.921875c0 5.523438 4.480469 10 10 10 5.523438 0 10-4.476562 10-10v-46.921875h27.871094v46.921875c0 5.523438 4.476562 10 10 10s10-4.476562 10-10v-46.921875h13.808594c28.410156-.035156 51.433594-23.058594 51.464844-51.46875v-9.457031h46.570312c5.523438 0 10-4.476563 10-10 0-5.519532-4.476562-10-10-10h-46.570312v-32.21875h46.570312c5.523438 0 10-4.476563 10-10 0-5.523438-4.476562-10-10-10h-46.570312v-32.21875h46.570312c5.523438 0 10-4.476563 10-10 0-5.523438-4.476562-10-10-10h-46.570312v-27.867188zm-66.570312 161.761719c-.019532 17.371094-14.097657 31.449219-31.464844 31.46875h-195.574219c-17.371094-.019531-31.449219-14.097656-31.46875-31.46875v-195.570313c.019531-17.371093 14.097656-31.449218 31.46875-31.46875h195.574219c17.367187.019532 31.445312 14.097657 31.464844 31.46875zm0 0"/>
                                <path id="logo2" d="m208.925781 131.652344c-41.683593 0-75.476562 33.792968-75.476562 75.476562s33.789062 75.476563 75.472656 75.476563c41.6875 0 75.476563-33.792969 75.476563-75.476563-.046876-41.664062-33.808594-75.425781-75.472657-75.476562zm0 130.953125c-30.640625 0-55.476562-24.835938-55.476562-55.476563 0-30.636718 24.835937-55.476562 55.476562-55.476562 30.636719 0 55.476563 24.839844 55.472657 55.476562-.035157 30.625-24.851563 55.441406-55.472657 55.476563zm0 0"/>
                            </svg>
                        </div>
                        <div class="links right">
                            <a href="../sell/sell.php">SELL</a>
                            <a id="login" href="../account/account.php?user=$userId">$username $kind</a>
                            <a id="cart" href="../store/cart.php">$cart_status</a>
                        </div>
                    </div>
EOT;
    }

    function template_footer()
    {
        echo <<<EOT
        <div class="footer">
            <ul>ElectroStore</ul>
            <ul>team@ElectroStore.com</ul>
            <ul>1-8000-ELCT</ul>
        </div>
EOT;
    }

    function SumTotal()
    {
        $userId = $_COOKIE['userID'];
        $conn = OpenCon();
        $sql = "SELECT Total FROM transactions WHERE UserID = '$userId'";
        $result = mysqli_query($conn, $sql);
        $total = 0;
        while ($row = mysqli_fetch_array($result)) {
            $total += $row['Total'];
        }
        CloseCon($conn);
        return $total;
    }