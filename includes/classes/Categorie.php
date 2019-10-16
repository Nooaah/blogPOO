<?php

class Categorie
{
    private $id;
    private $name;
    
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
    
    //  name
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function getName(): string
    {
        return $this->name;
    }
}