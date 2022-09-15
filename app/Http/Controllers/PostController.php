<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;

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

    public function toggle(Request $request, $post_id)
    {
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::withCount('comments')->withCount('reactions')->inRandomOrder()->get();
        if(!is_null($posts)){
        return view('user.home')->with(['posts' => $posts]);
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
    public function store(StorePostRequest $request)
    {
        // Retrieve the validated input data...
        // $data = $request->validated();
        // $categoryData = $this->category->createData($data);
        $data = $request->validated();

        $user_id = $request->user()->id;
        $post = new Post();
        $post->user_id = $user_id;
        $post->title = $request->post_title;
        $post->content = $request->post_content;
        $post->picture = uniqueNameAndMove($request->file('post_picture'), 'my_posts/images');
        $post->save();
        return back();
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
