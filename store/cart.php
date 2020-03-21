<?php
    session_start();

    include_once('../home/functions.php');
    template_header('Cart');

    if(isset($_SESSION['UserId'])){
        echo <<<EOT
        <div class="cart">
            <a>Cart</a>
            <table style="border-spacing: 10px;">
                <form name="form" action="../store/pay.php" method="POST">
                    <tr>
                        <td style="border-bottom:1px solid black;" colspan="3">Item</td>
                        <td style="border-bottom:1px solid black;">Quantity</td>
                        <td style="border-bottom:1px solid black;">Price</td>
                    </tr>
EOT;

        $conn = OpenCon();
        $cart = $_SESSION['Cart'];
        $totalPrice = 0;
        $totalShipping = 0;

        foreach ($cart as &$itemId){
            $sql = "SELECT * FROM data WHERE ID = '$itemId'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result);

            $item = $row['Item'];
            $description = $row['Description'];
            $price = $row['Price'];
            $totalPrice += $price;
            $quantity = $row['Quantity'];
            $category = $row['Category'];
            $shipping = $row['Shipping'];
            $totalShipping += $shipping;
            $sellerId = $row['SellerID'];
            $image = $row['Image'];

            echo <<<EOT
                    <tr>
                        <td style="width:100px;">
                            <img src="../images/uploads/$image" alt="Item 1" style="max-width:100%;max-height:100%;">
                        </td>
                        <td>
                            <p style="cursor: pointer;" onclick="window.location='../store/item.php?item=$itemId'">$item</p>
                        </td>
                        <td>
                            <ul>
                                $description
                            </ul>
                        </td>
                        <td>
                            <p>1</p>
                        </td>
                        <td>
                            <p>$price$</p>
                        </td>
                    </tr>
EOT;
        }
        echo <<<EOT
                    <tr>
                        <td colspan="2">
                            <p>
                                Payment:
                            </p>
                            <label for="No"><input style="display: flex;" type="radio" name="payment" value="No" id="No" checked="checked"/><a style="display: flex;">Credit</a></label>
                            <label for="Yes"><input style="display: flex;" type="radio" name="payment" value="Yes" id="Yes" /><a style="display: flex;">Paypal</a></label>
                        </td>
                        <td colspan="3">
                            <p>
                                Total: $totalPrice$, Shipping: $totalShipping$
                            </p>
                            <button type="submit">Order!</button>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
EOT;



    } else header('Location: ../account/sign.php');
?>

