<?php

namespace Domain\Comments\Actions;

use App\Models\Comment;
use Domain\Comments\DataTransferObjects\CommentData;
use Domain\Posts\DataTransferObjects\PostData;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowCommentsForThisPostAction
{
    use AsAction;

    public function  __construct()
    {
        // …
    }

    public function handle($id)
    {
        $comments = Comment::where('post_id', $id)->get();
        return $comments;
    }

    // public function execute( PostData $postData ): Post
    // {
    //     return new Post([
    //     'title' => $postData->title,
    //     'content' => $postData->content,
    //     'picture' => $postData->picture,
    //     ]);
    // }
}
