<!--TODO do this file in OOP . Dont't use $_SERVER['PHP_SELF'] -->
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <p>Enter login<input type="text" name="login" value="<?= $login ?>"></p>
    <p>Enter password<input type="password" name="pass" value="<?= $pass ?>"></p>
    <p>Remember me <input type="checkbox" name="setCookie" <?= $setCookie ?>></p>
    <input type="submit" value="go">
</form>
<? if ($error): ?>
    <p><?= $error ?></p>
<? endif; ?>