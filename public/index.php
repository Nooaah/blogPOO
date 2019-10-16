<?php

require_once '../includes/config.php';

$pt = new PostTable();

if (isset($_POST['title']) && isset($_POST['content'])) {
    $post = new Post();
    $post->setTitle($_POST['title']);
    $post->setContent($_POST['content']);
    $pt->create($post);
}

$posts = $pt->all();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Blog</h1>
        <div class="row">
            <? foreach($posts as $post): ?>
                <div class="col-md-4">
                    <h2><?= $post['title'] ?></h2>
                    <p><?= $post['content'] ?></p>
                </div>
            <? endforeach; ?>
        </div>
        <h1>Add a Post</h1>
        <div class="row">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label for="title">Content</label>
                    <textarea class="form-control" name="content"></textarea>
                </div>
                <input type="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</body>
</html>
