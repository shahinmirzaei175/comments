<?php

namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface CommentRepositoryInterface extends CrudRepositoryInterface
{
    public function paginate(Model $model);
    public function storeModelComment(Model $model,array $data);
}
