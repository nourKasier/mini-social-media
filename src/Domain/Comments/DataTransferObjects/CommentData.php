<?php

namespace Domain\Comments\DataTransferObjects;

use Spatie\LaravelData\Data;

class CommentData extends Data
{
    public function __construct(
        public ?int $id,
        public ?int $user_id,
        public ?int $post_id,
        public ?int $reply_to,
        public string $content,
    ) {
    }

    public static function make($commentData, $post_id)
    {
        $user_id = $commentData->user()->id;
        $commentData = $commentData->validated();
        $commentData['user_id'] = $user_id;
        $commentData['post_id'] = $post_id;
        return $commentData;
    }

    public static function makeReply($commentData, $reply_to)
    {
        $user_id = $commentData->user()->id;
        $commentData = $commentData->validated();
        $commentData['user_id'] = $user_id;
        $commentData['reply_to'] = $reply_to;
        return $commentData;
    }
}
