<?php
    session_start();

    include_once('../home/functions.php');

    if(isset($_SESSION['UserName'])) {
        if (!isset($_SESSION['Cart']))
            $_SESSION['Cart'] = array();
        if (isset($_GET['remove']) and isset($_SESSION['Kind'])){
            if($_SESSION['Kind'] == '1'){
                $conn = OpenCon();
                $rem_id = $_GET['remove'];
                $sql = "DELETE FROM data WHERE ID = '$rem_id'";
                mysqli_query($conn, $sql);
                CloseCon($conn);
            }
        } else {
            if (isset($_GET['add_to_cart'])) {
                array_push($_SESSION['Cart'], $_GET['add_to_cart']);
                header('Location: store.php');
            }
        }
    } else {
        if(isset($_GET['add_to_cart'])){
            header('Location: ../account/sign.php');
        }
    }
    if(isset($_GET['item'])){
        header('Location: item.php?item='.$_GET['item']);
    }
?>
<?php template_header('Store') ?>
<div class="store">
    <div class="search_banner">
        <form name="form" action="" method="get">
            <input type="text" name="search" placeholder="Search">
            <button type="submit" onclick="$('#php_items').load('pull.php');">
                <svg height="416pt" viewBox="0 -2 416 416" width="416pt" xmlns="http://www.w3.org/2000/svg">
                    <path fill="gray"
                          d="m309.394531 256.53125c-11.09375-11.0625-28.828125-11.738281-40.730469-1.554688l-19.835937-19.832031c22.4375-25.746093 34.785156-58.746093 34.753906-92.894531 0-78.183594-63.605469-141.792969-141.789062-141.792969-78.183594 0-141.792969 63.605469-141.792969 141.792969 0 78.183594 63.605469 141.789062 141.792969 141.789062 34.148437.03125 67.15625-12.3125 92.898437-34.753906l19.835938 19.835938c-10.1875 11.90625-9.507813 29.640625 1.554687 40.734375l85.582031 85.582031c3.90625 3.90625 10.238282 3.90625 14.144532 0l39.175781-39.179688c3.90625-3.902343 3.90625-10.234374 0-14.140624zm-167.597656 7.507812c-67.265625.003907-121.796875-54.523437-121.796875-121.789062-.003906-67.265625 54.523438-121.792969 121.789062-121.792969 67.265626 0 121.792969 54.527344 121.792969 121.792969-.074219 67.230469-54.558593 121.714844-121.789062 121.789062zm206.933594 110.183594-78.511719-78.511718c-3.898438-3.90625-3.898438-10.234376 0-14.140626l10.894531-10.894531c3.90625-3.898437 10.234375-3.898437 14.140625 0l78.511719 78.511719zm0 0"/>
                </svg>
            </button>
        </form>
    </div>
    <div id="php_items">
        <?php include('pull.php') ?>
    </div>
</div></div>

<?php template_footer() ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../account/account_settings.js"></script>
</body>
</html>