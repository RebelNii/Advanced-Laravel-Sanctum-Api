<?php

namespace Tests\Feature\V1\Post;

use App\Events\Models\User\UserEvent;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test index.
     *
     * @return void
     */
    // public function test_index()
    // {
    //     // $response = $this->get('/posts');
    //     $response = $this->json('get', '/api/v1/posts');

    //     $response->assertStatus(200);
    //     // dump($response->json());

    // }

    // public function test_show()
    // {
    //     $postID = Post::query()->find(2);
    //     // dump($postID->id);
    //     $response = $this->json('get', '/api/v1/posts/' . $postID->id);

    //     $result = $response->assertStatus(200)->json('data');
    //     // dump($result);

    //     $this->assertEquals($response['id'], $postID->id);
    // }

    public function test_create()
    {
        // Event::fake();
        //make() not Create() because we dont want to save it to Database
        $dummy = Post::factory()->make();

        $response = $this->json('post', '/api/v1/post', $dummy->toArray());

        $result = $response->assertStatus(201)->json('data');

        // Event::assertDispatched(UserEvent::class);

        $result = collect($result)->only(array_keys($dummy->getAttributes()));

        $result->each(function($value, $field) use($dummy){
            $this->assertSame(data_get($dummy, $field), $value, 'different');
        });
    }

    public function test_update(){
        $post = Post::factory()->create();
        $dummy = Post::factory()->make();

        // dump($post);

        //get fillables properties from Post model
        $fillables = collect((new Post())->getFillable());

        $fillables->each(function($toUpdate) use($post, $dummy) {
            $response = $this->json('put', '/api/v1/post/' . $post->id, [
                $toUpdate => data_get($dummy, $toUpdate),
            ]);
            $result = $response->assertStatus(200)->json('data');

            $this->assertSame(data_get($dummy, $toUpdate), data_get($post->refresh(), $toUpdate));
        });

    }

    public function test_delete(){
        $post = Post::factory()->create();

        $response = $this->json('delete', '/api/v1/post/' . $post->id);

        $response->assertStatus(200);
    }
}
