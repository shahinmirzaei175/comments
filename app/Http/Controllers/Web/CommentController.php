<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public CommentRepositoryInterface $commentRepository;
    public PostRepositoryInterface $postRepository;

    /**
     * Inject Dependencies.
     *
     * @param PostRepositoryInterface $postRepository
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(PostRepositoryInterface $postRepository, CommentRepositoryInterface $commentRepository)
    {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $post_id
     * @param CommentStoreRequest $request
     * @return RedirectResponse
     */
    public function store($post_id, CommentStoreRequest $request): RedirectResponse
    {
        $data = $request->only(['comment', 'name']);
        $post = $this->postRepository->find($post_id);
        $this->commentRepository->storeModelComment($post, $data);

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $post_id
     * @param $comment_id
     * @param CommentStoreRequest $request
     * @return RedirectResponse
     */
    public function reply($post_id, $comment_id, CommentStoreRequest $request): RedirectResponse
    {
        $data = $request->only(['comment', 'name']);
        $data['parent_id'] = $comment_id;
        $post = $this->postRepository->find($post_id);
        $this->commentRepository->storeModelComment($post, $data);

        return redirect()->back();
    }
}
