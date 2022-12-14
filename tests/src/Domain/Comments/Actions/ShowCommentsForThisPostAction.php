<?php

namespace Domain\Comments\Actions;

use App\Models\Comment;
use Domain\Comments\DataTransferObjects\CommentData;
use Domain\Posts\DataTransferObjects\PostData;

class ShowCommentsForThisPostAction
{
    //public function __invoke(PostData $postData): Post //error idk why.
    public function __invoke(PostData $postData)
    {
        // …
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

    public function execute($id)
    {
        $comments = Comment::where('post_id', $id)->get();
        return $comments;
    }

}
