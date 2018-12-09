<form action="/admin" method="post">
    <select name="user" id="">
        <?foreach ($users as $user): ?>
            <option value="<?=$user['id']?>"><?=$user['name']?></option>
        <?endforeach;?>
    </select>
    <select name="role" id="">
        <?foreach ($roles as $role): ?>
            <option value="<?=$role['id']?>"><?=$role['role']?></option>
        <?endforeach;?>
    </select>
    <input type="submit" value="save">
</form>