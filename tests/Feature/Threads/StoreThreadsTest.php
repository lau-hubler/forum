<?php

namespace Tests\Feature\Threads;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_an_authenticated_user_can_create_a_new_thread()
    {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->raw();

        $response = $this->actingAs($user)->post('/threads', $thread);

        $response->assertRedirect( route('threads.show', 1) );
        $this->assertDatabaseCount('threads',1);
    }

    public function test_an_unauthenticated_user_cannot_create_a_thread()
    {
        $thread = factory(Thread::class)->raw();

        $response = $this->post('/threads', $thread);

        $response->assertRedirect( route('login') );
        $this->assertDatabaseCount('threads', 0);
    }

    /**
     * @dataProvider storeProvider
     **/
    public function test_a_thread_cannot_be_created_due_validation_error($threadData, $field)
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/threads', $threadData);

        $response->assertSessionHasErrors($field);

    }

    public function storeProvider()
    {
        $threadData = [
            'title' => 'Cool Title',
            'body' => 'Awesome Content!'
        ];

        return[
            'title field is null' => [
                array_replace_recursive($threadData, ['title' => '']),
                'title'
            ],
            'title field is too short' => [
                array_replace_recursive($threadData, ['title' => 'a']),
                'title'
            ],
            'title field is too long' => [
                array_replace_recursive($threadData, ['title' => Str::length(256)]),
                'title'
            ],
            'body field is null' => [
                array_replace_recursive($threadData, ['body' => '']),
                'body'
            ],
            'body filed is too short' => [
                array_replace_recursive($threadData, ['body' => 'a']),
                'body'
            ]
        ];
    }


}
