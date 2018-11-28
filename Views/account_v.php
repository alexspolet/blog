<!--TODO do this file in OOP . Dont't use $_SERVER['PHP_SELF'] -->
<p>Hello admin. You authorized successfully</p>
<p><a href='/'>To the main page</a></p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
  <input type="submit" value="exit" name="exit">
</form>
