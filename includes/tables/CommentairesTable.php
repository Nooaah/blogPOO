<?php

class CommentairesTable
{
    protected $table = 'commentaires';
    private $db;

    public function __construct()
    {
        global $db;
        $this->db = $db;
    }

    //Create Commentaire
    public function create(Commentaire $commentaire)
    {
        global $db;
        $sth = $db->prepare("INSERT INTO commentaires(id_user, id_post, content, date) VALUES(?,?,?,?)");;
        $sth->execute(array($commentaire->getUserId(), $commentaire->getIdPost(), $commentaire->getContent(), time()));
    }

    //Retrieve Commentaire
    public function all(Post $post): array
    {
        $sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE id_post = ?");
        $sth->execute(array($post->getId()));
        return $sth->fetchAll();
    }
    public function get(Commentaire $commentaire)
    {
        $sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $sth->execute(array($commentaire->getId()));
        return $sth->fetch();
    }
    public function get_com_by_id($id)
    {
        global $db;
        $sth = $db->prepare("SELECT * FROM commentaires where id_post = ?");
        $sth->execute(array($id));
        return $sth;
    }
    

    //Update Commentaire
    public function update(Commentaire $commentaire): void
    {
        $sth = $this->db->prepare("UPDATE {$this->table} SET content = ? WHERE id = ?");
        $sth->execute(array($commentaire->getContent(), $commentaire->getId()));

        if (!$sth) {
            throw new Exception("Error during updating with the table {$this->table}");
        }
    }

    //Delete Commentaire
    public function delete(Commentaire $commentaire): void
    {
        $sth = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $sth->execute(array($commentaire->getId()));

        if (!$sth) {
            throw new Exception("Error during updating with the table {$this->table}");
        }
    }

}
