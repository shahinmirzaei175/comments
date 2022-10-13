<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Base\CrudRepository;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CommentRepository extends CrudRepository implements CommentRepositoryInterface
{
    /**
     * Set repository model object.
     *
     * @return Comment
     */
    protected function model(): Comment
    {
        return new Comment();
    }

    /**
     * Get list of comments.
     *
     * @param Model $model
     * @return mixed
     */
    public function paginate(Model $model): mixed
    {
        return $model->comments()->with('replies')->orderBy('created_at', 'DESC')->paginate(10);
    }

    /**
     * Store comment.
     *
     * @param Model $model
     * @param array $data
     * @return bool
     */
    public function storeModelComment(Model $model, array $data): bool
    {
        $comment = new Comment($data);
        $model->comments()->save($comment);

        return true;
    }
}
