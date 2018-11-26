<? if ($article): ?>
    <h1><?= $article['title'] ?></h1>
    <div class="text"><?= $article['text'] ?></div>
<? endif; ?>
<? if ($auth): ?>
    <p>
        <a href="edit.php?aid=<?= $article['id'] ?>">Edit article</a>
        <a href="delete.php?aid=<?= $article['id'] ?>">Delete article</a>
    </p>
<? endif; ?>
<p><a href="<?= $mainfile ?>">To the main page</a></p>