<?php

namespace Tests\Feature\Threads;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ShowThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();
        $this->response = $this->get('/threads/' . $this->thread->id);
    }

    public function test_an_unautheticated_user_can_see_thread_details()
    {
        $this->response->assertViewIs('threads.show');
    }

    public function test_user_can_see_title_of_a_specific_thread()
    {
        $this->response->assertSee($this->thread->title);
    }

    public function test_user_can_see_body_of_a_specific_thread()
    {
        $this->response->assertSee($this->thread->body);
    }

    public function test_user_can_see_creator_of_a_specific_thread()
    {
        $this->response->assertSee($this->thread->creator->name);
    }
}
