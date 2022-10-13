<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repositories\CommentRepository;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public PostRepositoryInterface $postRepository;
    public CommentRepositoryInterface $commentRepository;

    /**
     * Inject Dependencies
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
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $posts = $this->postRepository->get();
        return view('web.posts.index',compact('posts'));
    }

    /**
     * Show single post data
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id): View|Factory|Application
    {
        $post = $this->postRepository->find($id);
        $comments = $this->commentRepository->paginate($post);
        return view('web.posts.show',compact(['post', 'comments']));
    }


}
