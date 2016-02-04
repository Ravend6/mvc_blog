<?php
$title = 'Index';
?>
<?php require(realpath(__DIR__ . '/../include/header.php')); ?>
<h1><?= $title ?></h1>
<h4>Всего постов <?= $count ?></h4>
<?php foreach ($posts as $post): ?>
    <article>
        <h4><a href="/post/show?id=<?= $post->id ?>"><?= $post->title ?></a></h4>
        <p><em>Author: <?= $post->username ?></em></p>
        <p><?= nl2br($post->body, false) ?></p>
    </article>
    <hr>
<?php endforeach ?>
<?php require(realpath(__DIR__ . '/../include/footer.php')); ?>
