<?php


namespace Tests\Feature\Concerns;

use Illuminate\Foundation\Testing\WithFaker;

trait ReplyTestHasDataProvider
{

    protected $replyData = [
        'user_id' => 1,
        'thread_id' => 1,
        'body' => 'Aspernatur et eum facere quam recusandae. Cumque blanditiis molestiae aspernatur est.',
    ];

    /**
     * Data provider for store validations test
     *
     * @return array
     */
    public function storeTestDataProvider(): array
    {
        return [
            'body field is null' => [
                array_replace_recursive($this->replyData, ['body' => null]),
                'body'
            ],
            'thread_id field is null' => [
                array_replace_recursive($this->replyData, ['thread_id' => null]),
                'thread_id'
            ],
            'thread_id field is from nonexistence thread' => [
                array_replace_recursive($this->replyData, ['thread_id' => -1]),
                'thread_id'
            ],
        ];
    }
}
