<p>
    Hello
    <? if ($user): ?>
    <?= $user->fields['login'] ?>.</p>
<p>You authorized successfully</p>
<? if (!empty($roles)): ?>

    <? if (in_array('admin', $roles)): ?>
        <a href="/admin">Панель администратора</a>
    <? endif; ?>
    <? if (in_array('moderator', $roles)): ?>
        <a href="/moderator">Панель модератора</a>
        <form action="/account" method="post">
            <input type="submit" value="exit" name="exit">
        </form>
    <? endif; ?>
<? endif; ?>
<? else: ?>
    guest.
<? endif; ?>
</p>

<p><a href='/'>To the main page</a></p>








