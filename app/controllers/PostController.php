<?php
namespace App\Controllers;
use Lib\Core\Db;

class PostController extends Controller
{
    public function create()
    {
        $db = Db::getInstance();
        // $sql = "SELECT post_id, tag_id FROM post_tag";
        $sql = "SELECT id, name FROM tags";
        $tags = $db->connect->query($sql)->fetchAll(\PDO::FETCH_OBJ);
        $sql = "SELECT id, username FROM users";
        $users = $db->connect->query($sql)->fetchAll(\PDO::FETCH_OBJ);

        return $this->render('post/create', compact('tags', 'users'));
    }

    public function store()
    {
        if ($_POST['title'] and $_POST['body'] and isset($_POST['user_id']) and isset($_POST['tags'])) {
            $db = Db::getInstance();
            $sql = "INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)";
            $stmt = $db->connect->prepare($sql);
            $stmt->bindParam(':user_id', $_POST['user_id']);
            $stmt->bindParam(':title', $_POST['title']);
            $stmt->bindParam(':body', $_POST['body']);
            $stmt->execute();

            $postId = $db->connect->lastInsertId();

            foreach ($_POST['tags'] as $tag) {
                $sql = "INSERT INTO post_tag (post_id, tag_id) VALUES (:post_id, :tag_id)";
                $stmt = $db->connect->prepare($sql);
                $stmt->bindParam(':post_id', $postId);
                $stmt->bindParam(':tag_id', $tag);
                $stmt->execute();
            }

            header('Location: /');
        }

        $_SESSION['title'] = $_POST['title'];
        $_SESSION['body'] = $_POST['body'];

        $db = Db::getInstance();
        // $sql = "SELECT post_id, tag_id FROM post_tag";
        $sql = "SELECT id, name FROM tags";
        $tags = $db->connect->query($sql)->fetchAll(\PDO::FETCH_OBJ);
        $sql = "SELECT id, username FROM users";
        $users = $db->connect->query($sql)->fetchAll(\PDO::FETCH_OBJ);

        return $this->render('post/create', [
            'errors' => 'Заполните все поля',
            'tags' => $tags,
            'users' => $users,
        ]);
    }

    public function show()
    {
        $post = $this->findPost();
        if (!$post) return $this->render('error/404');
        // $db = Db::getInstance();
        // p.id, p.title, p.body, p.created_at

        // p.id, p.title, p.body, p.created_at, t.name
        // $sql = "SELECT * FROM posts as p ";
        // $sql .= "INNER JOIN post_tag as pt ON p.id = pt.post_id ";
        // $sql .= "INNER JOIN tags as t ON t.id = pt.tag_id ";
        // $sql .= "WHERE p.id = {$post->id}";

        // SELECT m.name, cp.id_category
        // FROM manufacturer as m
        // INNER JOIN product as p
        //     ON m.id_manufacturer = p.id_manufacturer
        // INNER JOIN category_product as cp
        //     ON p.id_product = cp.id_product
        // WHERE cp.id_category = 'some value'

        // $sql = "SELECT * FROM posts as p ";
        // $sql .= "JOIN post_tag as pt ON p.id = pt.post_id ";
        // $sql .= "WHERE pt.post_id = {$post->id}";
        // $tags = $db->connect->query($sql)->fetchAll(\PDO::FETCH_OBJ);
        // echo '<pre>';
        // var_dump($tags);
        // echo '</pre>';
        // return ;

        return $this->render('post/show', compact('post'));
    }

    public function edit()
    {
        $post = $this->findPost();
        if (!$post) return $this->render('error/404');

        return $this->render('post/edit', compact('post'));
    }

    public function update()
    {
        $post = $this->findPost();
        if (!$post) return $this->render('error/404');

        $post->title = $_POST['title'];
        $post->body = $_POST['body'];
        if ($_POST['title'] and $_POST['body']) {
            $db = Db::getInstance();
            $sql = "UPDATE posts SET title = :title, body = :body WHERE id = :id";
            $stmt = $db->connect->prepare($sql);
            $stmt->bindParam(':id', $_GET['id']);
            $stmt->bindParam(':title', $_POST['title']);
            $stmt->bindParam(':body', $_POST['body']);
            $stmt->execute();

            header('Location: /post/show?id=' . $_GET['id']);
        }
        return $this->render('post/edit', ['errors' => 'Заполните все поля', 'post' => $post]);
    }

    public function destroy()
    {
        $post = $this->findPost();
        if (!$post) return $this->render('error/404');

        $db = Db::getInstance();
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $db->connect->prepare($sql);
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();

        header('Location: /');

    }

    private function findPost()
    {
        $db = Db::getInstance();
        $id = $_GET['id'];
        $sql = "SELECT id, title, body, created_at FROM posts where id = :id";
        $stmt = $db->connect->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $post = $stmt->fetchAll(\PDO::FETCH_OBJ)[0];

        return $post;
    }
}