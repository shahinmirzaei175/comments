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
    public function index()
    {
        $posts = $this->postRepository->get();
        return view('web.posts.index',compact('posts'));
    }


    public function show($id)
    {
        $post = $this->postRepository->find($id);
        $comments = $this->commentRepository->paginate($post);
        return view('web.posts.show',compact(['post', 'comments']));
    }


}
