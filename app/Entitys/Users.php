<?php

namespace app\Entitys;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "users")]

class Users
{

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "string", length: 255)]
    private string $email;

    #[ORM\Column(type: "string", length: 72)]
    private string $password;

    #[ORM\Id]
    #[ORM\Column(type: "string", length: 36)]
    private string $uuid;

    #[ORM\Column(type: "boolean")]
    private bool $adm = false;

    public function setName(string $name): void
    {

        $this->name = $name;
    }
    

    public function setEmail(string $email): void
    {

        $this->email = $email;
    }
    

    public function setPassword(string $password): void
    {

        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    

    function __construct(string $uuid)
    {

        $this->uuid = $uuid;
    }
    

    public function getPassword(): string
    {

        return $this->password;
    }
    

    public function getUuid(): string
    {

        return $this->uuid;
    }
    

    public function getName(): string
    {

        return $this->name;
    }
    

    public function getAdm(): string
    {

        return $this->adm;
        
    }
    

}