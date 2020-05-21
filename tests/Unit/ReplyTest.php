<?php

namespace Tests\Unit;

use App\Reply;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\User;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    public function test_it_has_an_owner()
    {
        $reply = create(Reply::class);

        $this->assertInstanceOf(User::class, $reply->owner);
    }
}
