<?php

class User
{
    private $id;
    private $password;
    private $pseudo;
    private $mail;
    private $image;
    
    public function getID(): int
    {
        return $this->id;
    }

    public function setID(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    
    public function setMail(string $mail): self
    {
        $this->mail = $mail;
        return $this;
    }

    public function getMail(): string
    {
        return $this->mail;
    }
    
    public function SetPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    public function getPassword(): string
    {
        return $this->password;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

}