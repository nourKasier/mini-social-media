<?php

namespace Domain\Posts\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class DeletePostAction
{
    use AsAction;

    public function  __construct()
    {
        // …
    }

    public function handle($post)
    {
        $success = $post->delete();
        return $success ? true : false;
    }

    // public function execute( PostData $postData ): Post
    // {
    //     return new Post([
    //     'title' => $postData->title,
    //     'content' => $postData->content,
    //     'picture' => $postData->picture,
    //     ]);
    // }
    // public function execute( $post )
    // {
    //     //some processing if needed
    //     $success = $post->delete();
    //     return $success;
    // }
}
