<?php
    session_start();

    include_once('../home/functions.php');
    template_header('Home');
?>

<div class="main_banner" onclick="window.location.href='../store/store.php'">
    <a>ElectroStore</a>
    <img src="../images/down_arrow.png" width="100px" height="100px" alt="GO SIGN">
</div>

<?php template_footer() ?>
<script src="../account/account_settings.js"></script>
</body>
</html>