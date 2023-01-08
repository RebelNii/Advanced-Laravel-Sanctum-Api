<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Exceptions\GeneralException;
use App\Models\Post;
use App\Repositories\PostRepositories;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    public function test_create()
    {
        /**
         * Run test on post model
         * 1. define goal of test
         * will create method actually create data 
         * 2. replicate evn / restriction
         * 3.results expected or source of truth
         * 4.compare results of tests against expected results
         */
        $repo = $this->app->make(PostRepositories::class);

        $payload = [
            'title' => 'test1',
            'body' => "{}"
        ];

        $res = $repo->create($payload);

        $this->assertSame($payload['title'],$res->title, 'Type does not match');
    }
    public function test_update()
    {
        $repo = $this->app->make(PostRepositories::class);

        $post = Post::find(4);

        $payload = ['title' => 'abc'];

        $res = $repo->update($post,$payload);

        $this->assertSame($payload['title'], $res->title, 'Updated failed');
    }


    public function test_delete()
    {
        $repo = $this->app->make(PostRepositories::class);

        $post = Post::find(8);

        $res = $repo->delete($post);

        $del = Post::query()->find($post->id);

        $this->assertSame(null, $del, 'Failed to delete');
    }
}
