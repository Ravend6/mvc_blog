<?php
$title = $post->title;
?>
<?php require(realpath(__DIR__ . '/../include/header.php')); ?>
<article>
    <h2><?= $post->title ?></h2>
    <p><?= nl2br($post->body, false) ?></p>
    <a href="/post/edit?id=<?= $post->id ?>">Edit</a>
    <a href="/post/delete?id=<?= $post->id ?>">Delete</a>
</article>
<?php require(realpath(__DIR__ . '/../include/footer.php')); ?>
