<?php

namespace Domain\Comments\Actions;

use App\Models\Comment;
use Domain\Comments\DataTransferObjects\CommentData;
use Domain\Posts\DataTransferObjects\PostData;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowRepliesForThisCommentAction
{
    use AsAction;

    public function  __construct()
    {
        // …
    }

    public function handle($comment_id)
    {
        $replies_of_this_comment = Comment::where('reply_to', $comment_id)->get();
        return $replies_of_this_comment;
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
