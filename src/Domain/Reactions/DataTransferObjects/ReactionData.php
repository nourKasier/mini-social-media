<?php

namespace Domain\Reactions\DataTransferObjects;

// use Illuminate\Http\UploadedFile;

use Spatie\LaravelData\Data;

class ReactionData extends Data
{
    public function __construct(
        public int $id,
        public int $user_id,
        public int $post_id,
    ) {
    }

    public static function make($reactionData, $post_id)
    {
        $user_id = $reactionData->user()->id;
        $reactionData['user_id'] = $user_id;
        $reactionData['post_id'] = $post_id;
        return $reactionData;
    }
}
