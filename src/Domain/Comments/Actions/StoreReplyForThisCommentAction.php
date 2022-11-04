<?php

namespace Domain\Comments\Actions;

use Domain\Comments\DataTransferObjects\CommentData;
use Domain\Posts\DataTransferObjects\PostData;

class StoreReplyForThisCommentAction
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

    public function execute($request, $comment_id, $comment)
    {
        $data = new CommentData(...$request->validated());
        $data = (array) $data;
        $data['user_id'] = $request->user()->id;
        $data['reply_to'] = $comment_id;
        $success = $comment->create($data);
        return $success;
    }

}
