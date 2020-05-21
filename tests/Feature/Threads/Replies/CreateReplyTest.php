<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Tests\Feature\Threads\Replies;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateReplyTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    private $thread;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thread = create(Thread::class);
    }

    public function test_an_unauthenticated_user_cannot_create_a_reply()
    {
        $reply = makeRaw(Reply::class);

        $response = $this->post('/threads/' . $this->thread->id . '/replies', $reply );

        $response->assertRedirect(route('login'));
    }

    public function test_an_authenticated_user_can_create_a_reply()
    {
        $reply = makeRaw(Reply::class);

        $response = $this->signIn()->post('/threads/' . $this->thread->id . '/replies', $reply );

        $response->assertRedirect('/threads/' . $this->thread->id);
        $this->assertDatabaseCount('replies', 1);
    }

    public function test_a_empty_reply_cannot_be_created()
    {
        $response = $this->signIn()->post('/threads/' . $this->thread->id . '/replies', [ 'body' => '']);

        $response->assertSessionHasErrors('body');
    }
}
