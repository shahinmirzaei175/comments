<?php

namespace App\Providers;

use App\Repositories\Base\CrudRepository;
use App\Repositories\CommentRepository;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\CrudRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Base crud
        $this->app->bind(CrudRepositoryInterface::class,CrudRepository::class);

        //Entities Repo
        $this->app->bind(PostRepositoryInterface::class,PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class,CommentRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
