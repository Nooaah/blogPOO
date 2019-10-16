<?php

class Commentaire
{
    private $id;
    private $userId;
    private $content;
    private $idPost;
    
    //  id
    public function getID(): int
    {
        return $this->id;
    }
    public function setID(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    
    //  userid
    public function setUserId(string $userId): self
    {
        $this->userId = $userId;
        return $this;
    }
    public function getUserId(): string
    {
        return $this->userId;
    }
    
    //  idPost
    public function setIdPost(string $idPost): self
    {
        $this->idPost = $idPost;
        return $this;
    }
    public function getIdPost(): string
    {
        return $this->idPost;
    }

    //  content
    public function getContent(): string
    {
        return $this->content;
    }
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    //  date
    public function setDate(string $date): self
    {
        $this->date = time();
        return $this;
    }
    public function getDate(): string
    {
        return $this->date;
    }

}