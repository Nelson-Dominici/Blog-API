<?php

namespace app\Entitys;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "posts")]

class Posts
{

    #[ORM\Column(type: "string", length: 100)]
    private string $title;

    #[ORM\Column(type: "datetime", length: 15)]
    private \DateTimeInterface $postDate;

    #[ORM\Column(type: "text")]
    private string $contente;

    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
    private string $postUuid;

    public function setTitle(string $title): void
    {

        $this->title = $title;
    
    }

    public function setContente(string $contente): void
    {

        $this->contente = $contente;
    
    }

    public function getTitle(): string
    {

        return $this->title;
    
    }

    public function getContente(): string
    {

        return $this->contente;
    
    }

    function __construct(\DateTimeInterface $postDate, string $postUuid)
    {

        $this->postDate = $postDate;
        $this->postUuid = $postUuid;
    
    }

}
