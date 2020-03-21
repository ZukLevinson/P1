<?php
    session_start();

    include_once '../home/functions.php';

    $conn = OpenCon();

    if(isset($_GET['item'])){
        $itemId = $_GET['item'];
        $sql = "SELECT * FROM data WHERE ID = '$itemId'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            template_header("Item Not Found | ElectroStore");
            echo "<a style='color:white;'>Item Not Found</a>";
        } else {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $item = $row['Item'];
            $description = $row['Description'];
            $price = $row['Price'];
            $quantity = $row['Quantity'];
            $category = $row['Category'];
            $shipping = $row['Shipping'];
            $sellerId = $row['SellerID'];
            $image = $row['Image'];
            template_header($item . " | ElectroStore");


            echo <<<EOT
<div class="itemPage">
    <table style="width:100%;">
        <form name="form" action="" method="get">
        <tr style="width:100%;">
            <td style="width:50%;">
                <img src="../images/uploads/$image" alt="$item Imagery" style="max-width:100%;max-height:100%;">
            </td>
            <td style="width:50%;padding-left:3%;">
                <table>
                    <tr>
                        <td>
                            <a id="itemName">$item</a>
                        </td>
                        <td style="width:30%;">
                            <p id="category">
                                | $category
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <ul id="description">
                                $description
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <button style="width:100%;" type="submit">BUY NOW: $price$</button>
                            <input type="hidden" name="add_to_cart" value="$itemId">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        </form>
    </table>
</div>

<?php template_footer() ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../account/account_settings.js"></script>
</body>
</html>
EOT;
        }
    }
    if(isset($_SESSION['UserName'])) {
        if (!isset($_SESSION['Cart'])) $_SESSION['Cart'] = array();

        if (isset($_GET['add_to_cart'])) {
            array_push($_SESSION['Cart'], $_GET['add_to_cart']);
            header('Location: store.php');
        } else header('Location: item.php?item='.$itemId);
    }
    template_footer();
?>