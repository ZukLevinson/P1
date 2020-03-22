<?php
    session_start();

    include_once('../home/functions.php');
    template_header('Account');

    if (isset($_GET['logout'])) {
        RemoveSession();
        session_destroy();
        setcookie("PHPSESSID","");
        header('Location: ../home/index.php');
    }

    if($_GET['user']==""){
        header('Location: ../account/sign.php');
    } else {
        $sumTotal = SumTotal();

        $user = $_SESSION['UserId'];
        $userName = $_SESSION['UserName'];

        $conn = OpenCon();
        $sqlUser = "SELECT Email FROM users WHERE ID ='$user'";
        $resultUser = mysqli_query($conn,$sqlUser);
        $row = mysqli_fetch_array($resultUser);

        $email = $row['Email']!="" ? $row['Email'] : "No Email";

        echo <<<EOR
<div class="account">
    <table class="account_info" cellspacing="20px">
        <a>Account #$user</a>
        <tr style="width:100%;">
            <td style="border-bottom:1px solid black;">
                Username:
            </td>
            <td style="border-bottom:1px solid black;">
                Email:
            </td>
            <td style="border-bottom:1px solid black;">
                Total:
            </td>
            <td style="border-bottom:1px solid black;">
                Log Out:
            </td>
        </tr>
        <tr>
            <td>
                $userName
            </td>
            <td>
                $email
            </td>
            <td>
                $sumTotal$
            </td>
            <td>
                <p onclick="window.location+='&logout=true'">LOGOUT</p>
            </td>
        </tr>
    </table>
    <div class="line"></div>
    <table class="transactions" cellspacing="20px">
        <a>Transactions</a>
        <tr>
            <td style="border-bottom:1px solid black;">
                Transaction ID:
            </td>
            <td style="border-bottom:1px solid black;">
                Items:
            </td>
            <td style="border-bottom:1px solid black;">
                Total:
            </td>
            <td style="border-bottom:1px solid black;">
                Shipping:
            </td>
            <td style="border-bottom:1px solid black;">
                Paid:
            </td>
            <td style="border-bottom:1px solid black;">
                Time:
            </td>
        </tr>
EOR;

        $sql = "SELECT * FROM transactions WHERE UserID = '$user'";


        $result = mysqli_query($conn,$sql);
        if (!$result) {
            echo "<a>" . mysqli_error($conn) . "</a>";
        } else {
            while ($row = mysqli_fetch_array($result)) {
                $userId = $row['UserID'];
                $transaction = $row['TransactionID'];
                $itemsId = $row['ItemsID'];
                $total = $row['Total'];
                $shipping = $row['Shipping'];
                $paid = $row['Paid'];
                $time = $row['Time'];
                $itemsName = "";

                $itemsIdArray =explode(',',$itemsId);
                foreach($itemsIdArray as &$item){
                    $sqlItems = "SELECT Item FROM data WHERE ID = '$item'";
                    $resultItems = mysqli_query($conn,$sqlItems);
                    $row = $resultItems->fetch_array(MYSQLI_ASSOC);
                    $itemsName = $itemsName . $row['Item'] . "<br>";
                }




                echo <<<EOT
<tr>
            <td>
                <p>
                    $transaction
                </p>
            </td>
            <td>
                <p>
                    $itemsName
                </p>
            </td>
            <td>
                <p>
                    $total$
                </p>
            </td>
            <td>
                <p>
                    $shipping$
                </p>
            </td>
            <td>
                <p>
                    $paid
                </p>
            </td>
            <td>
                <p>
                    $time
                </p>
            </td>
        </tr>
EOT;
            }
            echo <<<EOT
    </table>
</div>
EOT;

        }

    }
?>

<?php template_footer() ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../account/account_settings.js"></script>
</body>
</html>