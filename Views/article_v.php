<? if ($article): ?>
    <h1><?= $article['title'] ?></h1>
    <div class="text"><?= $article['text'] ?></div>
<? endif; ?>
<? if ($auth): ?>
    <p>
        <a href="/edit?id=<?= $article['id'] ?>">Edit article</a>
        <a href="/delete?id=<?= $article['id'] ?>">Delete article</a>
    </p>
<? endif; ?>
<p><a href="<?= '/' ?>">To the main page</a></p>