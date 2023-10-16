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
    private \DateTimeInterface $date;

    #[ORM\Column(type: "text")]
    private string $content;

    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
    private string $uuid;

    #[ORM\Column(type: "string", length: 36)]
    private string $userUuid;

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setUserUuid(string $userUuid): void
    {
        $this->userUuid = $userUuid;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getUserUuid(): string
    {
        return $this->userUuid;
    }

    function __construct(\DateTimeInterface $date, string $uuid)
    {
        $this->date = $date;
        $this->uuid = $uuid;
    }
}