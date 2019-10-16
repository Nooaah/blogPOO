<?php

class UsersTable
{
    protected $table = 'users';
    private $db;

    public function __construct()
    {
        global $db;
        $this->db = $db;
    }

    public function all(): array
    {
        $sth = $this->db->query("SELECT * FROM {$this->table}");
        return $sth->fetchAll();
    }

    public function get(int $id): User
    {
        $sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $sth->execute(array($id));
        $sth = $sth->fetch();
        $pt = new User();

        $pt->setID($sth['id']);
        $pt->setPseudo($sth['pseudo']);
        $pt->setPassword($sth['password']);
        $pt->setImage($sth['image']);
        $pt->setMail($sth['mail']);
        
        return $pt;
    }

    public function create(Post $post)
    {
        $sth = $this->db->prepare("INSERT INTO {$this->table} (title, content, id_user, image, categorie, date) VALUES (?, ?, ?, ?, ?, ?)");
        $sth->execute(array($post->getTitle(),$post->getContent(),$post->getIdUser(),$post->getImage(),$post->getCategorie(),$post->getDate()));
        $result = $sth->execute();

        if (!$result) {
            throw new Exception("Error during creation with the table {$this->table}");
        }
    }

    public function update(Post $post): void
    {
        $sth = $this->db->prepare("UPDATE {$this->table} SET title = ? AND content = ? WHERE id = ?");
        $sth->execute(array($post->getTitle(), $post->getContent()));
        $result = $sth->execute();

        if (!$result) {
            throw new Exception("Error during updating with the table {$this->table}");
        }
    }

    public function delete(int $id): void
    {
        $sth = $this->db->prepare("DELETE FROM {$this->table} id = ?");
        $sth->execute(array($post->getID()));

        if (!$result) {
            throw new Exception("Error during deleting with the table {$this->table}");
        }    
    }


}
