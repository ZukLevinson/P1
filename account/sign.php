<?php
    session_start();

    include_once('../home/functions.php');
    template_header('Sign in or Sign up');

    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: ../home/index.php');
    }
    if (isset($_SESSION['UserId'])){
        header('Location: ../account/account.php?user='.$_COOKIE['userID']);
    }
?>
<div class="login" id="sign-in" style="display: block;">
    <a>Log In</a>
    <form action="../account/sign-in.php" method="POST">
        <table>
            <tr>
                <td>
                    <ul>Email or Username:</ul>
                    <label>
                        <input type="text" name="user">
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <ul>Password:</ul>
                    <label>
                        <input type="password" name="pass">
                    </label>
                </td>
            </tr>
            <tr>
                <td style="padding-bottom:5px;">
                    <?php if (isset($_SESSION['Errors'])): ?>
                        <div class="form-errors">
                            <?php foreach ($_SESSION['Errors'] as $error): ?>
                                <ul style="color:darkred;"><?php echo $error ?></ul>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <button type="submit">Lets Go!</button>
                </td>
            </tr>
            <tr>
                <td onclick="InOrUp()">
                    <a style="font-size: 12px;">Don't have a user yet? <a id="signage" style="text-decoration: underline;font-size: 12px; color:black;">Sign up!</a></a>
                </td>
            </tr>
        </table>
    </form>
</div>
<div class="login" id="sign-up" style="display: none;">
    <a>Sign Up</a>
    <form action="../account/sign-up.php" method="POST">
        <table>
            <tr>
                <td>
                    <ul>Email:</ul>
                    <label>
                        <input type="text" name="emil">
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <ul>Username:</ul>
                    <label>
                        <input type="text" name="user">
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <ul>Password:</ul>
                    <label>
                        <input type="password" name="pass">
                    </label>
                </td>
            </tr>
            <tr>
                <td style="padding-bottom:5px;">
                    <button type="submit">Sign Up</button>
                </td>
            </tr>
            <tr>
                <td>
                    <a style="font-size: 12px;">Have a user? <a onclick="InOrUp()"
                                                                style="text-decoration: underline;font-size: 12px; color:black;">Log
                            in!</a></a>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php template_footer() ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../account/account_settings.js"></script>
</body>
</html>