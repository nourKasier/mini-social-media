<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\For_;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    //public function toggle(Request $request, $post_id)
    public function toggle(Request $request, $post_id)
    {
        $userId = Auth::id();
        $get_record = Reaction::where('user_id', $userId)
        ->where('post_id', $post_id)
        ->first();
        if($get_record === null){
        $reaction = new Reaction();
        $reaction->user_id = $userId;
        $reaction->post_id = $post_id;
        $reaction->created_at = now();
        $reaction->updated_at = now();
        $reaction->save();
        return response()->json(['success' => 'Post liked successfully.']);
        }else{
            Reaction::where('user_id', $userId)
            ->where('post_id', $post_id)
            ->delete();
            return response()->json(['success' => 'Post unliked successfully.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
        $posts = Post::with('user:id,name')->withCount('comments')->withCount('reactions')->inRandomOrder()->get();
        if(!is_null($posts)){
        return view('user.home')->with(['posts' => $posts])->with(['userId'=>$userId]);
        }
        else
        {dd('there is no posts yet.');}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate

        $userId = Auth::id();
        $post = new Post();
        $post->user_id = $userId;
        $post->title = $request->postTitle;
        $post->content = $request->postContent;
        $post->picture = $request->postPicture;
        $post->created_at = now();
        $post->updated_at = now();
        $post->save();
        return redirect('createPostPage')->with('status', 'Post Data Has Been inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
