<?php

namespace app\Entitys;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "comments")]

class Comments
{

    #[ORM\Column(type: "datetime", length: 15)]
    private \DateTimeInterface  $commentDate;

    #[ORM\Column(type: "string", length: 36)]
    private string $userUuid;

    #[ORM\Column(type: "string", length: 36)]
    private string $postUuid;

    #[ORM\Column(type: "text")]
    private string $contente;

    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
    private string $commentUuid;

    public function setUserUuid(string $userUuid): void
    {

        $this->userUuid = $userUuid;

    }

    public function setPostUuid(string $postUuid): void
    {

        $this->postUuid = $postUuid;

    }

    public function setContente(string $contente): void
    {

        $this->contente = $contente;

    }

    public function getCommentDate(): \DateTimeInterface
    {

        return $this->commentDate;

    }

    public function getCommentUuid(): string
    {

        return $this->commentUuid;

    }

    function __construct(\DateTimeInterface $commentDate, string $commentUuid)
    {

        $this->commentDate = $commentDate;
        $this->commentUuid = $commentUuid;

    }

}
