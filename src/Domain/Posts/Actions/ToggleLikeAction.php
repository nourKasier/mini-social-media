<?php

namespace Domain\Posts\Actions;

use App\Models\Post;
use App\Models\Reaction;
use Domain\Posts\DataTransferObjects\PostData;
use Illuminate\Http\Request;

class ToggleLikeAction
{
    //public function __invoke(PostData $postData): Post //error idk why.
    public function __invoke(Post $post)
    {
        // …
        //some processing
        //$post->delete();
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
    public function execute( $request, $post_id )
    {
        //some processing if needed
        // $data = $request->validated();
        //     if(array_key_exists("picture", $data)){
        //         $data['picture'] = uniqueNameAndMove($data['picture'], 'my_posts/images');
        //     }
        // $success = $post->update($data);


        $user_id = $request->user()->id;
        $get_record = Reaction::where('user_id', $user_id)->where('post_id', $post_id)->first();
        if($get_record === null){
        $reaction = new Reaction();
        $reaction->user_id = $user_id;
        $reaction->post_id = $post_id;
        $reaction->save();
        return response()->json(['success' => 'Post liked successfully.']);
        }else{
            Reaction::where('user_id', $user_id)
            ->where('post_id', $post_id)
            ->delete();
            return response()->json(['success' => 'Post unliked successfully.']);
        }
    }
}
