<?php

namespace Domain\Comments\Actions;

use App\Models\Comment;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateCommentAction
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
}
