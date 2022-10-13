<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CommentFactory extends Factory
{
    /**
     * The name of factory model
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $commentable = $this->commentable();
        return [
            "name"          => $this->faker->name(),
            "comment"       => $this->faker->text(200),
            'commentable_id' => $commentable::factory(),
            'commentable_type' => $commentable,
        ];
    }

    /**
     * Set morph model object
     *
     * @return mixed
     */
    public function commentable()
    {
        return $this->faker->randomElement([
            Post::class,
        ]);
    }
}
