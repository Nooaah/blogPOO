<?php

class PostTable
{
    protected $table = 'posts';
    private $db;

    public function __construct()
    {
        global $db;
        $this->db = $db;
    }

    //Create post
    public function create(Post $post)
    {
        $sth = $this->db->prepare("INSERT INTO {$this->table} (title, content, id_user, image, categorie, date) VALUES (?, ?, ?, ?, ?, ?)");
        $sth->execute(array($post->getTitle(),$post->getContent(),$post->getIdUser(),$post->getImage(),$post->getCategorie(),$post->getDate()));

        if (!$sth) {
            throw new Exception("Error during creation with the table {$this->table}");
        }
    }

    //Retrieve posts
    public function all(): array
    {
        $sth = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $sth->fetchAll();
    }
    public function get(int $id): Post
    {
        $sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $sth->execute(array($id));
        $sth = $sth->fetch();

        $pt = new Post();
        $pt->setID($sth['id']);
        $pt->setIdUser($sth['id_user']);
        $pt->setImage($sth['image']);
        $pt->setTitle($sth['title']);
        $pt->setContent($sth['content']);
        $pt->setCategorie($sth['categorie']);
        $pt->setDate($sth['date']);
        $pt->setViews($sth['views']);

        return $pt;
    }
    public function getCat(int $id)
    {
        $sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE categorie = ? ORDER BY id DESC");
        $sth->execute(array($id));
        return $sth->fetchAll();
    }
    public function get_posts_by_user($id)
    {
        global $db;
        $getByCat = $db->prepare('SELECT * FROM posts WHERE id_user = ?');
        $getByCat->execute(array($id));
        return $getByCat->fetchAll();
    }

    //Update post
    public function update(Post $post)
    {
        $sth = $this->db->prepare("UPDATE {$this->table} SET title = ?, content = ? WHERE id = ?");
        $sth->execute(array($post->getTitle(), $post->getContent(), $post->getID()));

        if (!$sth) {
            throw new Exception("Error during updating with the table {$this->table}");
        }
    }
    
    //Delete posts
    public function delete(Post $post)
    {
        $sth = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $sth->execute(array($post->getID()));

        if (!$sth) {
            throw new Exception("Error during deleting with the table {$this->table}");
        }
    }

    //Ajoute +1 pour les vues
    public function add_view(Post $post)
    {
        $sth = $this->db->prepare("UPDATE {$this->table} SET views = views + 1 WHERE id = ?");
        $sth->execute(array($post->getId()));

        if (!$sth) {
            throw new Exception("Error during adding view with the table {$this->table}");
        }
    }

    public function get_user_by_mail_and_password($mail, $password)
    {
        global $db;
        $password = sha1($password);
        $get = $db->prepare('SELECT * FROM users WHERE mail = ? AND password = ?');
        $get->execute(array($mail, $password));
        return $get;
    }

    public function get_most_famous_posts()
    {
        $sth = $this->db->query("SELECT * FROM {$this->table} ORDER BY views DESC LIMIT 3");
        return $sth->fetchAll();
    }

    public function get_new_posts()
    {
        global $db;
        $getNewPosts = $db->prepare('SELECT * FROM posts ORDER BY id DESC LIMIT 3');
        $getNewPosts->execute();
        return $getNewPosts->fetchAll();
    }

}
