<?php

class CategoriesTable
{
    protected $table = 'categories';
    private $db;

    public function __construct()
    {
        global $db;
        $this->db = $db;
    }

    //Create Categorie
    public function create(Categorie $categorie)
    {
        $sth = $this->db->prepare("INSERT INTO {$this->table} (name) VALUES (?)");
        $sth->execute(array($cat->getName()));

        if (!$sth) {
            throw new Exception("Error during creation with the table {$this->table}");
        }
    }

    //Retrieve Categorie
    public function all(): array
    {
        $sth = $this->db->query("SELECT * FROM {$this->table}");
        return $sth->fetchAll();
    }
    public function get(int $id)
    {
        $sth = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $sth->execute(array($id));
        return $sth->fetch();
    }
    public function get_categorie_by_id($id)
    {
        global $db;
        $ins = $db->prepare('SELECT * FROM categories WHERE id = ?');
        $ins->execute(array($id));
        $ins = $ins->fetch();
        return $ins['name'];
    }
    public function get_categorie_id_by_name($name)
    {
        global $db;
        $ins = $db->prepare('SELECT * FROM categories WHERE name = ?');
        $ins->execute(array($name));
        $ins = $ins->fetch();
        return $ins['id']; 
    }

    //Update Categorie
    public function update(Categorie $categorie): void
    {
        $sth = $this->db->prepare("UPDATE {$this->table} SET name = ? WHERE id = ?");
        $sth->execute(array($categorie->getName(), $categorie->getId()));

        if (!$sth) {
            throw new Exception("Error during updating with the table {$this->table}");
        }
    }

    //Delete Categorie
    public function delete(Categorie $categorie): void
    {
        $sth = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $sth->execute(array($categorie->getId()));

        if (!$sth) {
            throw new Exception("Error during updating with the table {$this->table}");
        }
    }

}
