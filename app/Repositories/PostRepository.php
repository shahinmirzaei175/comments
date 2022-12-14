<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Base\CrudRepository;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository extends CrudRepository implements PostRepositoryInterface
{
    /**
     * Set repository model object.
     *
     * @return Post
     */
    protected function model(): Post
    {
        return new Post();
    }

    /**
     * Get list of posts.
     *
     * @return mixed
     */
    public function get()
    {
        return $this->model()->orderBy('created_at', 'DESC')->get();
    }
}
