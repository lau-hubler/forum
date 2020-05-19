<?php /** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Tests\Feature\Threads\Replies;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Concerns\ReplyTestHasDataProvider;
use tests\Mockery\Generator\ClassWithDebugInfo;
use Tests\TestCase;

class CreateReplyTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;
    use ReplyTestHasDataProvider;

    private $thread;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();
    }

    public function test_an_unauthenticated_user_cannot_create_a_reply()
    {
        $reply = factory(Reply::class)->make();

        $response = $this->post('/threads/' . $this->thread->id . '/replies', $reply->toArray() );

        $response->assertRedirect(route('login'));
    }

    public function test_an_authenticated_user_can_create_a_reply()
    {
        $user = factory(User::class)->create();
        $reply = factory(Reply::class)->make();

        $response = $this->actingAs($user)->post('/threads/' . $this->thread->id . '/replies', $reply->toArray() );

        $response->assertRedirect('/threads/' . $this->thread->id);
        $this->get('/threads/' . $this->thread->id)->assertSee($reply->body);
        $this->assertDatabaseCount('replies', 1);
    }

    /**
     * @dataProvider storeTestDataProvider
     * @param array $replyData
     * @param string $field
     */
    public function test_a_reply_cannot_be_created_due_validations_problems( array $replyData, string $field)
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/threads/' . $this->thread->id . '/replies', $replyData );

        $response->assertSessionHasErrors($field);
    }
}
