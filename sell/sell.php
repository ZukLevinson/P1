<?php
    session_start();

    include_once('../home/functions.php');
    template_header('Sell Online');
?>
        <div class="sell_banner">
            <form method="post" action="push.php" enctype="multipart/form-data">
                <table style="width:100%;">
                    <tr>
                        <td style="width:50%;text-align: center;">
                            <input type="file" name="image">
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
                                        <input step="0.01" type="number" name="pric">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:50%">
                            <ul>Free Shipping</ul>
                            <label for="Yes"><input type="radio" name="ship" value="0" id="Yes" checked="checked"/>Yes</label>
                            <label for="No"><input type="radio" name="ship" value="No" id="No" />No</label>
                            <input step="0.01" type="number" name="ship_other" id="ship_other">
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
        <?php template_footer() ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../account/account_settings.js"></script>
    </body>
</html>