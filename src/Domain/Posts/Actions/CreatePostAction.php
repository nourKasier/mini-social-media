<?php

namespace Domain\Posts\Actions;

use App\Models\Post;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePostAction
{
    use AsAction;

    protected $post;

    public function  __construct(Post $post)
    {
        $this->post = $post;
    }

    public function handle($postData)
    {
        $success = $this->post->create($postData);
        return $success ? true : false;
    }

    // public function execute($request)
    // {
    //     $data = new PostData(...$request->validated());
    //     $data = (array) $data;
    //     $data['user_id'] = $request->user()->id;
    //     $data['picture'] = uniqueNameAndMove($data['picture'], 'my_posts/images');
    //     $success = $this->post->create($data);

    //     return $success;
    // }
}
