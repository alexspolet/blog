<? if (!empty($errors)): ?>
  <? foreach ($errors as $error): ?>
        <p><?= $error; ?></p>
  <? endforeach; ?>
<? else: ?>
    <p>File was deleted successfully</p>
<? endif; ?>
<p><a href="<?= '/' ?>">To the main file</a></p>
