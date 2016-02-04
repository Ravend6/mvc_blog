<?php
$title = $post->title;
?>
<?php require(realpath(__DIR__ . '/../include/header.php')); ?>
<?php if (isset($errors)): ?>
    <div>
        <ul>
            <li style="color: red"><?= $errors ?></li>
        </ul>
    </div>
<?php endif ?>
<form action="/post/update?id=<?= $post->id ?>" method="post">
    <div>
        <label for="title">Title</label>
        <input type="title" name="title" id="title" value="<?= $post->title ?>">
    </div>
    <div>
        <label for="body">Body</label>
        <textarea name="body" id="body" cols="30" rows="10"><?= $post->body ?></textarea>
    </div>
    <div>
        <button type="submit">Обновить</button>
    </div>
</form>
<?php require(realpath(__DIR__ . '/../include/footer.php')); ?>