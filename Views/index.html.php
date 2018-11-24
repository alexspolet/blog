<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
</head>
<body>
<div>
  <? foreach ($articles as $item):?>
  <p><a href="index.php?act=one&id=<?=$item['id']?>"><?=$item['name']?></a></p>
  <?endforeach;?>
</div>
</body>
</html>