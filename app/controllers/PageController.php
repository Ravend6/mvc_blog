<?php
namespace App\Controllers;
use Lib\Core\Db;

class PageController extends Controller
{
    public function getIndex()
    {
        $sql = "SELECT p.*, u.id as author_id, u.username FROM posts as p ";
        $sql .= "INNER JOIN users as u ON u.id = p.user_id ORDER BY created_at DESC";
        $db = Db::getInstance();
        $posts = $db->connect->query($sql)->fetchAll(\PDO::FETCH_OBJ);
        $count = $db->connect->query("SELECT COUNT(*) FROM posts")->fetchColumn();
        // echo '<pre>';
        // var_dump($posts);
        // echo '</pre>';
        // return ;
        return $this->render('page/index', compact('posts', 'count'));
    }

    public function getAbout()
    {
        return $this->render('page/about');
    }
}