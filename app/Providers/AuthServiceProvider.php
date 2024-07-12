<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Comment;
use App\Models\Post;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();

        Gate::define('update-post', function ($user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('delete-post', function ($user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('update-comment', function ($user, Comment $comment) {
            return $user->id === $comment->user_id;
        });

        Gate::define('delete-comment', function ($user, Comment $comment) {
            return $user->id === $comment->user_id || $user->id === $comment->post->user_id;
        });
    }
}
