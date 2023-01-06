<?php

namespace Domain\Posts\Actions;

use App\Models\Post;
use Lorisleiva\Actions\Concerns\AsAction;

class BringPostsInRandomOrderAction
{
    use AsAction;

    public function  __construct()
    {
        //
    }

    public function handle()
    {
        $posts = Post::withCount('comments')
            ->withCount('reactions')
            ->inRandomOrder()
            ->get();
        return $posts;
    }
}
