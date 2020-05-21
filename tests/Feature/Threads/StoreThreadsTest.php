<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Tests\Feature\Threads;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\Concerns\ThreadsTestHasDataProvider;
use Tests\TestCase;

class StoreThreadsTest extends TestCase
{
    use DatabaseMigrations;
    use ThreadsTestHasDataProvider;

    public function test_an_authenticated_user_can_create_a_new_thread()
    {
        $thread = makeRaw(Thread::class);

        $response = $this->signIn()->post('/threads', $thread);

        $response->assertRedirect( route('threads.show', 1) );
        $this->assertDatabaseCount('threads',1);
    }

    public function test_an_unauthenticated_user_cannot_create_a_thread()
    {
        $thread = makeRaw(Thread::class);

        $response = $this->post('/threads', $thread);

        $response->assertRedirect( route('login') );
        $this->assertDatabaseCount('threads', 0);
    }

    /**
     * @dataProvider storeProvider
     * @param $threadData
     * @param $field
     */
    public function test_a_thread_cannot_be_created_due_validation_error($threadData, $field)
    {
        $response = $this->signIn()->post('/threads', $threadData);

        $response->assertSessionHasErrors($field);

    }
}
