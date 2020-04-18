<?php
    session_start();

    include_once('../home/functions.php');
    template_header('Account');

    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: ../home/index.php');
    }

    if ($_GET['user'] == "") {
        header('Location: ../account/sign.php');
    } else {
        $sumTotal = SumTotal();

        $user = $_SESSION['UserId'];
        $userName = $_SESSION['UserName'];
        $kind = $_SESSION['Kind'] == "0" ? "User" : "Admin";

        $conn = OpenCon();
        $sqlUser = "SELECT Email FROM users WHERE ID ='$user'";
        $resultUser = mysqli_query($conn, $sqlUser);
        $row = mysqli_fetch_array($resultUser);

        $email = $row['Email'] != "" ? $row['Email'] : "No Email";

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
                Kind:
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
                $kind
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


        $result = mysqli_query($conn, $sql);
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

                $itemsIdArray = explode(',', $itemsId);
                foreach ($itemsIdArray as $item) {
                    $sqlItems = "SELECT Item FROM data WHERE ID = '$item'";
                    $resultItems = mysqli_query($conn, $sqlItems);
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
            echo '</table>';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($_POST['action'] == 'add') {
                    $id = $_POST['id'];
                    $sql = "UPDATE users SET Kind = '1' WHERE ID = '$id'";
                    mysqli_query($conn, $sql);
                    CloseCon($conn);
                } else {
                    $id = $_POST['id'];
                    $sql = "UPDATE users SET Kind = '0' WHERE ID = '$id'";
                    mysqli_query($conn, $sql);
                    CloseCon($conn);
                }

            }

            if ($_SESSION['Kind'] == '1') {
                $sql = "SELECT Username FROM users";
                $conn = OpenCon();
                $result = mysqli_query($conn, $sql);
                $totalUsers = mysqli_num_rows($result);

                $totalPaid = 0;
                $totalNotPaid = 0;
                $sql = "SELECT Total FROM transactions WHERE Paid = 'Yes'";
                $result = mysqli_query($conn, $sql);
                while ($transactionCurr = mysqli_fetch_array($result)) {
                    $totalPaid += $transactionCurr['Total'];
                }
                $sql = "SELECT Total FROM transactions WHERE Paid = 'No'";
                $result = mysqli_query($conn, $sql);
                while ($transactionCurr = mysqli_fetch_array($result)) {
                    $totalNotPaid += $transactionCurr['Total'];
                }
                CloseCon($conn);
                echo <<<EOT
        <div class="line"></div>
        <a>Add Admin</a>
        <form method="post">
            <input type="number" name="id" placeholder="Account ID">
            <input type="hidden" name="action" value="add">
            <button type="submit">Add</button>
        </form>
        
        <div class="line"></div>
        <a>Remove Admin</a>
        <form method="post">
            <input type="number" name="id" placeholder="Account ID">
            <input type="hidden" name="action" value="remove">
            <button type="submit">Remove</button>
        </form>
        
        <div class="line"></div>
        <a>Statistics</a>
        </br> Number of users: $totalUsers
        </br> Amount of cash unpaid: $totalPaid$
        </br> Amount of cash paid: $totalNotPaid$
EOT;
            }
            echo <<<EOT

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