<?php

class Post
{
    private $id;
    private $title;
    private $content;
    private $categorie;
    private $image;
    
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
    
    //  id_user
    public function setIdUser(int $id): self
    {
        $this->IdUser = $id;
        return $this;
    }
    public function getIdUser(): string
    {
        return $this->IdUser;
    }

    //  image
    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }
    public function getImage(): string
    {
        return $this->image;
    }
    
    //  title
    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
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

    //  categorie
    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;
        return $this;
    }
    public function getCategorie(): string
    {
        return $this->categorie;
    }

    //  date
    public function setDate(): self
    {
        $this->date = time();
        return $this;
    }
    public function getDate(): string
    {
        return $this->date;
    }

    //  views
    public function setViews(string $views): self
    {
        $this->views = $views;
        return $this;
    }
    public function getViews(): string
    {
        return $this->views;
    }
}