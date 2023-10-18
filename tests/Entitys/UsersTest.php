<?php

namespace Tests\Entitys;

use Ramsey\Uuid\Uuid;

use app\Entitys\Users;

use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
{
    public function test_set_name(): void
    {
    	$name = "Nelson Dominici";

        $users = new Users(Uuid::uuid4());
        $users->setName($name);

        $this->assertEquals($name, $users->getName());
    }

    public function test_set_email(): void
    {
    	$email = "nelsondominici777@gmail.com";

        $users = new Users(Uuid::uuid4());
        $users->setEmail($email);

        $this->assertEquals($email, $users->getEmail());
    }

    public function test_get_adm(): void
    {
        $users = new Users(Uuid::uuid4());

        $this->assertFalse($users->getAdm());
    }

    public function test_get_uuid(): void
    {
    	$uuid = Uuid::uuid4();
        
        $users = new Users($uuid);

        $this->assertEquals($uuid, $users->getUuid());
    }
}