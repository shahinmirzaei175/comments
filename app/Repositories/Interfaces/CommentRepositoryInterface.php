<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface CommentRepositoryInterface extends CrudRepositoryInterface
{
    public function getModelCommentByEagerLoad(Model $model);

    public function storeModelComment(Model $model, array $data);
}
