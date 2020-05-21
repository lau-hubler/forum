<?php

namespace Tests\Feature\Threads;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class IndexThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_user_view_all_threads()
    {
        $response = $this->get('/threads');

        $response->assertStatus(200);
        $response->assertViewIs('threads.index');
    }

    public function test_user_can_see_lastest_thread_title_in_index()
    {
        factory(Thread::class, 50)->create();
        $thread = create(Thread::class);

        $response = $this->get('/threads');

        $response->assertSee($thread->title);
    }
}
