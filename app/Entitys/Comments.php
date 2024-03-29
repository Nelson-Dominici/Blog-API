<?php

namespace app\Entitys;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "comments")]

class Comments
{
    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface  $date;

    #[ORM\Column(type: "string", length: 36)]
    private string $userUuid;

    #[ORM\Column(type: "string", length: 36)]
    private string $postUuid;

    #[ORM\Column(type: "text")]
    private string $content;

    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
    private string $uuid;

    public function setUserUuid(string $userUuid): void
    {
        $this->userUuid = $userUuid;
    }

    public function setPostUuid(string $postUuid): void
    {
        $this->postUuid = $postUuid;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
    
    public function getUserUuid(): string
    {
        return $this->userUuid;
    }
    
    public function getPostUuid(): string
    {
        return $this->postUuid;
    }
    
    public function getContent(): string
    {
        return $this->content;
    }

    public function __construct(\DateTimeInterface $date, string $uuid)
    {
        $this->date = $date;
        $this->uuid = $uuid;
    }
}