<?php

namespace Tests\Feature\Repository;

use App\Models\Comment;
use App\Models\News;
use App\Models\Post;
use App\Repositories\CommentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test for insert comment
     *
     * @return void
     */
    public function test_insert_comment()
    {
        $commentRepository = new CommentRepository();
        $post = Post::factory()->create();
        $data = Comment::factory()->state([
            "commentable_id" => $post->id
        ])->make()->toArray();
        $res = $commentRepository->storeModelComment($post,$data);
        $this->assertTrue($res);
        $this->assertDatabaseCount('comments',1);
        $this->assertDatabaseHas('comments',$data);
    }

    /**
     * A test for insert reply for comment
     *
     * @return void
     */
    public function test_insert_reply_comment()
    {
        $commentRepository = new CommentRepository();
        $post = Post::factory()->create();
        Comment::factory()->create();
        $data = Comment::factory()->state([
            "commentable_id" => $post->id
        ])->make()->toArray();
        $res = $commentRepository->storeModelComment($post,$data);
        $this->assertTrue($res);
        $this->assertDatabaseCount('comments',2);
        $this->assertDatabaseHas('comments',$data);

    }
}
