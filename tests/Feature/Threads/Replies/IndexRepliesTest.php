<?php

namespace Tests\Feature\Threads\Replies;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexRepliesTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();
        $this->reply = factory(Reply::class)->create(['thread_id' => $this->thread->id]);
        $this->response = $this->get('/threads/' . $this->thread->id);
    }

    public function test_a_user_can_read_replies_associated_to_the_thread()
    {
        $this->response->assertSee($this->reply->body);
    }

    public function test_a_user_can_see_the_owner_of_a_reply()
    {
        $this->response->assertSee($this->reply->owner->name);
    }

    public function test_a_user_can_see_how_long_ago_a_reply_was_made()
    {
        $this->response->assertSee($this->reply->created_at->toCookieString());
    }
}
