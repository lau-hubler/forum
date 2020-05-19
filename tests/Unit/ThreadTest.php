<?php

namespace Tests\Unit;

use App\Thread;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    private $thread;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();
    }
    public function test_it_can_have_replies()
    {
        $this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    public function test_it_has_a_creator()
    {
        $this->assertInstanceOf(User::class, $this->thread->creator);
    }

    public function test_it_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foo',
            'user_id' => 1
        ]);

        $this->assertDatabaseCount('replies', 1);
    }
}
