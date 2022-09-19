<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-post', function (User $user, Post $post) {
        // return $user->id === $post->user_id;
        // });
        Gate::define('update-post', [PostPolicy::class, 'update']);
        // Gate::define('delete-post', function (User $user, Post $post) {
        //     return $user->id === $post->user_id;
        // });
        Gate::define('delete-post', [PostPolicy::class, 'delete']);
    }
}
