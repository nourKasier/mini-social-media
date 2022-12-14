<?php

namespace Domain\Posts\DataTransferObjects;

use Illuminate\Http\UploadedFile;

use Spatie\LaravelData\Data;

class PostData extends Data
{
    public function __construct(
        public ?int $id,
        public ?int $user_id,
        public string $title,
        public string $content,
        public UploadedFile $picture,
    ) {
    }

    public static function make($postData)
    {
        $user_id = $postData->user()->id;
        $postData = $postData->validated();
        $postData['user_id'] = $user_id;
        $postData['picture'] = uniqueNameAndMove($postData['picture'], 'my_posts/images');
        return $postData;
    }

    public static function update($postData)
    {
        $postData = $postData->validated();
        if (array_key_exists("picture", $postData)) {
            $postData['picture'] = uniqueNameAndMove($postData['picture'], 'my_posts/images');
        }
        return $postData;
    }
}
