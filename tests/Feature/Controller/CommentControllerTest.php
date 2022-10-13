<?php

namespace Tests\Feature\Controller;

use App\Models\Comment;
use App\Models\Post;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test for store comment method.
     *
     * @return void
     */
    public function test_store_method_comment(): void
    {
        $post = Post::factory()->create();

        $this->mock(PostRepositoryInterface::class, function (MockInterface $mock) use ($post) {
            $mock->shouldReceive('find')
                ->once()
                ->andReturn($post, ResponseAlias::HTTP_OK);
        });

        $this->mock(CommentRepositoryInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('storeModelComment')
                ->once()
                ->andReturn(true, ResponseAlias::HTTP_OK);
        });

        $data = Comment::factory()->state([
           'commentable_id' => $post->id,
        ])->create()->toArray();

        $response = $this->post(
            route('comments.store', $post->id),
            [
                'comment' =>    $data['comment'],
                'name' =>       $data['name'],
            ]
        );

        $this->assertDatabaseCount('comments', 1);
        $this->assertDatabaseHas('comments', $data);
        $response->assertRedirect();
    }

    /**
     * A test for store comment reply.
     *
     * @return void
     */
    public function test_store_reply_method(): void
    {
        $post = Post::factory()->create();

        $this->mock(PostRepositoryInterface::class, function (MockInterface $mock) use ($post) {
            $mock->shouldReceive('find')
                ->once()
                ->andReturn($post, ResponseAlias::HTTP_OK);
        });

        $this->mock(CommentRepositoryInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('storeModelComment')
                ->once()
                ->andReturn(true, ResponseAlias::HTTP_OK);
        });

        $comment = Comment::factory()->create();

        $data = Comment::factory()->state([
            'commentable_id' => $post->id,
        ])->create()->toArray();

        $response = $this->post(
            route('comments.reply', [$post->id, $comment->id]),
            [
                'comment' =>    $data['comment'],
                'name' =>       $data['name'],
            ]
        );

        $this->assertDatabaseCount('comments', 2);
        $this->assertDatabaseHas('comments', $data);
        $response->assertRedirect();
    }

    /**
     * A test for add comment validation error.
     *
     * @return void
     */
    public function test_validation_store_comment(): void
    {
        $post = Post::factory()->create();

        Comment::factory()->create();

        $response = $this->post(
            route('comments.store', $post->id),
            []
        );

        $response->assertSessionHasErrors();
    }

    /**
     * A test for add reply validation error.
     *
     * @return void
     */
    public function test_validation_store_reply(): void
    {
        $post = Post::factory()->create();

        $comment = Comment::factory()->create();

        $response = $this->post(
            route('comments.reply', [$post->id, $comment->id]),
            []
        );

        $response->assertSessionHasErrors();
    }
}
