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
    }
?>
<div class="account">
    <?php echo "<a>".SumTotal()."</a>" ?><br>
    <a onclick="window.location+='&logout=true'">LOGOUT</a>
</div>

<?php template_footer() ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../account/account_settings.js"></script>
</body>
</html>