<?php

namespace Tests\Entitys;

use Ramsey\Uuid\Uuid;

use app\Entitys\Posts;

use PHPUnit\Framework\TestCase;

class PostsTest extends TestCase
{
    public function test_set_title(): void
    {
    	$title = "Hello Word.";

        $posts = new Posts(new \DateTime(), Uuid::uuid4());
        $posts->setTitle($title);

        $this->assertEquals($title, $posts->getTitle());
    }

    public function test_set_userUuid(): void
    {
    	$userUuid = Uuid::uuid4();

        $posts = new Posts(new \DateTime(), Uuid::uuid4());
        $posts->setUserUuid($userUuid);

        $this->assertEquals($userUuid, $posts->getUserUuid());
    }

    public function test_set_content(): void
    {
    	$content = "Hello Word.";

        $posts = new Posts(new \DateTime(), Uuid::uuid4());
        $posts->setContent($content);

        $this->assertEquals($content, $posts->getContent());
    }

    public function test_constructor_method(): void
    {
        $uuid = Uuid::uuid4();
        
        $date = new \DateTime();
        
        $posts = new Posts($date, $uuid);

        $this->assertEquals($uuid, $posts->getUuid());
        $this->assertEquals($date, $posts->getDate());
    }
} 