<?php
    session_start();

    include_once('../home/functions.php');
?>
<?php template_header('Store') ?>
<div class="main_banner">
    <div class="banner_text" onclick="window.location.href='../store/store.php'">
<!--        <img style="opacity: 80%;position:absolute;" src="../images/Screen-Shot-2019-04-22-at-2.48.22-PM-1-e1555961353311.jpg">-->
        <a>ElectroStore</a>
        <img src="../images/down_arrow.png" width="100px" height="100px" alt="GO SIGN">
    </div>
</div>
<?php template_footer() ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../account/account_settings.js"></script>
</body>
</html>