<?php

namespace Domain\Posts\Actions;

use App\Models\Post;
use Domain\Posts\DataTransferObjects\PostData;
use Illuminate\Http\Request;

class DeletePostAction
{
    //public function __invoke(PostData $postData): Post //error idk why.
    public function __invoke(Post $post)
    {
        // …
        //some processing
        //$post->delete();
    }

    public function  __construct()
    {
        // …
    }

    // public function execute( PostData $postData ): Post
    // {
    //     return new Post([
    //     'title' => $postData->title,
    //     'content' => $postData->content,
    //     'picture' => $postData->picture,
    //     ]);
    // }
    public function execute( $post )
    {
        //some processing if needed
        $success = $post->delete();
        return $success;
    }
}
