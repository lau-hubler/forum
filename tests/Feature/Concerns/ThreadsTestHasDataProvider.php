<?php


namespace Tests\Feature\Concerns;


use Illuminate\Support\Str;

trait ThreadsTestHasDataProvider
{
    protected         $threadData = [
        'title' => 'Cool Title',
        'body' => 'Awesome Content!'
    ];

    public function storeProvider(): array
    {
        return[
            'title field is null' => [
                array_replace_recursive($this->threadData, ['title' => '']),
                'title'
            ],
            'title field is too short' => [
                array_replace_recursive($this->threadData, ['title' => 'a']),
                'title'
            ],
            'title field is too long' => [
                array_replace_recursive($this->threadData, ['title' => Str::length(256)]),
                'title'
            ],
            'body field is null' => [
                array_replace_recursive($this->threadData, ['body' => '']),
                'body'
            ],
            'body filed is too short' => [
                array_replace_recursive($this->threadData, ['body' => 'a']),
                'body'
            ]
        ];
    }
}
