<?php

namespace Domain\Comments\Actions;

use Domain\Comments\DataTransferObjects\CommentData;
use Domain\Posts\DataTransferObjects\PostData;

class CreateCommentAction
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

    public function execute($request, $post_id, $comment)
    {
        // $data = new PostData(...$request->validated());
        // $data = (array) $data;
        // //$data->picture = uniqueNameAndMove($data->picture, 'my_posts/images');
        // //$success = $post->create($data);
        // //return $success;
        // //$data = $request->validated();
        // $data['user_id'] = $request->user()->id;
        // $data['picture'] = uniqueNameAndMove($data['picture'], 'my_posts/images');
        // $success = $post->create($data);

        // return $success;

        $data = new CommentData(...$request->validated());
        $data = (array) $data;
        $data['user_id'] = $request->user()->id;
        $data['post_id'] = $post_id;
        $success = $comment->create($data);
        return $success;
        // return new Post([
        // 'title' => $postData->title,
        // 'content' => $postData->content,
        // 'picture' => $postData->picture,
        // ]);
    }

}
