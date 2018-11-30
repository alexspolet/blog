<?if ($auth):?>
    <p><a href="account.php">To the private account</a></p>
  <?else:?>
    <p><a href="/auth">Authorization</a></p>
<?endif;?>
<hr>

<?foreach ($articles as $item) :?>
<p>
    <a href="/article?id=<?=$item['id']?>"><?=$item['title']?></a>

  <?if ($auth):?>
    <a href="/edit?id=<?=$item['id']?>">Edit</a>
    <a href="/delete?id=<?=$item['id']?>">Delete</a>

  <?endif;?>
</p>
<?endforeach;?>

<hr>
<?if ($auth):?>
  <p><a href="/add">Add new article</a></p>
<?endif;?>
