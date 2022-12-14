<?php

namespace Domain\Posts\Actions;

use App\Models\Post;
use Domain\Posts\DataTransferObjects\PostData;
use Illuminate\Http\Request;

class CreatePostAction
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

    public function execute($request, $post)
    {
        $data = new PostData(...$request->validated());
        $data = (array) $data;
        //$data->picture = uniqueNameAndMove($data->picture, 'my_posts/images');
        //$success = $post->create($data);
        //return $success;
        //$data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['picture'] = uniqueNameAndMove($data['picture'], 'my_posts/images');
        $success = $post->create($data);

        return $success;
        // return new Post([
        // 'title' => $postData->title,
        // 'content' => $postData->content,
        // 'picture' => $postData->picture,
        // ]);
    }

}
