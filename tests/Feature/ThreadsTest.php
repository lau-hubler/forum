<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();
    }

    public function test_a_user_view_all_threads()
    {
        $response = $this->get('/threads');

        $response->assertStatus(200);
        $response->assertViewIs('threads.index');
    }

    public function test_user_can_see_lastest_thread_title_in_index()
    {


        $response = $this->get('/threads');

        $response->assertSee($this->thread->title);
    }

    public function test_user_can_see_a_specific_thread()
    {
        $response = $this->get('/threads/' . $this->thread->id);

        $response->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_replies_associated_to_the_thread()
    {
        $reply = factory(Reply::class)->create(['thread_id' => $this->thread->id]);

        $response = $this->get('/threads/' . $this->thread->id);

        $response->assertSee($reply->body);
    }
}
