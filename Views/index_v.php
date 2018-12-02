<?if ($auth):?>
    <p><a href="/account">To the private account</a></p>
  <?else:?>
    <p><a href="/auth">Authorization</a></p>
<?endif;?>
<hr>

<?foreach ($articles as $item) :?>
<p>
    <a href="/article/<?=$item['id']?>"><?=$item['title']?></a>

  <?if ($auth):?>
    <a href="/edit/<?=$item['id']?>">Edit</a>
    <a href="/delete/<?=$item['id']?>">Delete</a>

  <?endif;?>
</p>
<?endforeach;?>

<hr>
<?if ($auth):?>
  <p><a href="/add">Add new article</a></p>
<?endif;?>
