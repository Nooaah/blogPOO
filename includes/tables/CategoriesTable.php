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

    public function create(Post $post)
    {
        $sth = $this->db->prepare("INSERT INTO {$this->table} (title, content) VALUES (:title, :content)");
        $sth->bindParam(':title', $post->getTitle());
        $sth->bindParam(':content', $post->getContent());
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
        // todo
    }

}
