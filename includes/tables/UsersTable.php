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

    //Create User
    public function create(User $user)
    {
        $sth = $this->db->prepare("INSERT INTO {$this->table} (pseudo, password, image, mail) VALUES (?, ?, ?, ?)");
        $sth->execute(array($user->getPseudo(),$user->getPassword(),$user->getImage(),$user->getEmail()));
        $result = $sth->execute();

        if (!$result) {
            throw new Exception("Error during creation with the table {$this->table}");
        }
    }

    //Retrieve User
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

    //Update User
    public function update(Post $post): void
    {
        $sth = $this->db->prepare("UPDATE {$this->table} SET title = ? AND content = ? WHERE id = ?");
        $sth->execute(array($post->getTitle(), $post->getContent()));
        $result = $sth->execute();

        if (!$result) {
            throw new Exception("Error during updating with the table {$this->table}");
        }
    }

    //Delete User
    public function delete(User $user): void
    {
        $sth = $this->db->prepare("DELETE FROM {$this->table} id = ?");
        $sth->execute(array($user->getID()));

        if (!$result) {
            throw new Exception("Error during deleting with the table {$this->table}");
        }    
    }


}
