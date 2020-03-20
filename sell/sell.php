<?php
    session_start();

    if(isset($_GET['logout'])){
        session_destroy();
        header('Location: ../home/index.php');
    }
?>

<!DOCTYPE html>

<html land="en">
    <head>
        <title>Sell | ElectroStore</title>
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
                <a id="login">
                    <?php
                        if(isset($_SESSION['UserName'])){
                            echo $_SESSION['UserName'];
                        } else echo "LOGIN";
                    ?>
                </a>
            </div>
        </div>

        <div class="sell_banner">
            <form method="post" action="push.php" enctype="multipart/form-data">
                <table style="width:100%;">
                    <tr>
                        <td style="width:50%;text-align: center;">
<!--                            <input type="file" name="image">-->
                            <input type="hidden" name="size" value="1000000">
                            <ul>Description</ul>
                            <textarea cols="40" rows="4" name="dscr"></textarea>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <ul>Item Name</ul>
                                        <input type="text" name="name" placeholder="Toilet Papers...">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <ul>Category</ul>
                                        <input list="kinds" name="catg">
                                        <datalist id="kinds">
                                            <option value="PC">
                                            <option value="Vent">
                                            <option value="CPU">
                                            <option value="Laptop">
                                            <option value="GPU">
                                            <option value="Cable">
                                            <option value="Motor">
                                            <option value="MB">
                                            <option value="Sensor">
                                        </datalist>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <ul>Price</ul>
                                        <input type="number" name="pric">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50%">
                            <ul>Free Shipping</ul>
                            <label for="Yes"><input type="radio" name="ship" value="0" id="Yes" />Yes</label>   
                            <label for="No"><input type="radio" name="ship" value="No" id="No" />No</label>
                            <input type="number" name="ship_other" id="ship_other">
                        </td>
                        <td>
                            <ul>Quantity</ul>
                            <input type="number" name="quan">
                        </td>
                    </tr>
                </table>
                <?php if (isset($_SESSION['Errors_sell'])): ?>
                    <div class="form-errors">
                        <?php foreach($_SESSION['Errors_sell'] as $error): ?>
                            <ul style="color:darkred;"><?php echo $error ?></ul>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <button type="submit" name="subm">Sell!</button>
            </form>
        </div>
        <?php include("../normal/footer.html") ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../account/account_settings.js"></script>
    </body>
</html>