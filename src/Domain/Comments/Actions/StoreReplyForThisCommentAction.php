<?php

namespace Domain\Comments\Actions;

use App\Models\Comment;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreReplyForThisCommentAction
{
    use AsAction;

    protected $comment;

    public function  __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function handle($commentData)
    {
        $success = $this->comment->create($commentData);
        return $success ? true : false;
    }

    // public function execute($request, $comment_id, $comment)
    // {
    //     $data = new CommentData(...$request->validated());
    //     $data = (array) $data;
    //     $data['user_id'] = $request->user()->id;
    //     $data['reply_to'] = $comment_id;
    //     $success = $comment->create($data);
    //     return $success;
    // }

    // public function execute( PostData $postData ): Post
    // {
    //     return new Post([
    //     'title' => $postData->title,
    //     'content' => $postData->content,
    //     'picture' => $postData->picture,
    //     ]);
    // }
}
