<?php
$title = 'Создать новый пост';
?>
<?php require(realpath(__DIR__ . '/../include/header.php')); ?>
<h1><?= $title ?></h1>
<?php if (isset($errors)): ?>
    <div>
        <ul>
            <li style="color: red"><?= $errors ?></li>
        </ul>
    </div>
<?php endif ?>
<form action="" method="post">
    <div>
        <label for="title">Title</label>
        <input type="title" name="title" id="title" value="<?= old('title') ?>">
    </div>
    <div>
        <label for="body">Body</label>
        <textarea name="body" id="body" cols="30" rows="10"><?= old('body') ?></textarea>
    </div>
    <div>
        <select name="user_id">
            <?php foreach ($users as $user): ?>
                <option value="<?= $user->id ?>"><?= $user->username ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div>
        <select name="tags[]" multiple>
            <?php foreach ($tags as $tag): ?>
                <option value="<?= $tag->id ?>"><?= $tag->name ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div>
        <button type="submit">Создать</button>
    </div>
</form>
<?php require(realpath(__DIR__ . '/../include/footer.php')); ?>
