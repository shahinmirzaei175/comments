<?php

namespace Tests\Feature\Model;

use App\Models\Comment;
use App\Models\News;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_comment_model(): void
    {
         $data = Comment::factory()->count(1)
             ->for(Post::factory(), 'commentable')
             ->create()->toArray();
        $this->assertDatabaseCount('comments',1);
        $this->assertDatabaseHas('comments',$data[0]);
    }
}
