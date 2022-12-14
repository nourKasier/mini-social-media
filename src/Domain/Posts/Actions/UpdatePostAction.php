<?php

namespace Domain\Posts\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePostAction
{
    use AsAction;

    public function  __construct()
    {
        // …
    }

    public function handle($postData, $post)
    {
        //some processing if needed
        $success = $post->update($postData);
        return $success ? true : false;
    }

    // public function execute($request, $post)
    // {
    //     //some processing if needed
    //     $data = $request->validated();
    //     if (array_key_exists("picture", $data)) {
    //         $data['picture'] = uniqueNameAndMove($data['picture'], 'my_posts/images');
    //     }
    //     $success = $post->update($data);
    //     return $success;
    // }
}
