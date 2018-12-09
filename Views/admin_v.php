<form action="/admin" method="post">
    Найти пользователя<input type="text" name="user_login">
    <? /*foreach ($users as $user): */ ?><!--
            <option value="<? /*=$user['id']*/ ?>"><? /*=$user['name']*/ ?></option>
        --><? /*endforeach;*/ ?>
    <input type="submit" value="save">
</form>
<? if (!empty($users)): ?>
    <? foreach ($users as $user): ?>
        <p>
            <span><?= $user['name'] ?></span>
            <? if (isset($user['roles'])): ?>
                <? foreach ($user['roles'] as $role): ?>
                    <span>
                <?= $role ?>
            </span>
                <? endforeach; ?>
            <? endif; ?>
            <a href="/admin/addRole">Добавить роль</a>
            <a href="/admin/deleteRole">Удалить роль</a>
        </p>
    <? endforeach; ?>
<? endif; ?>