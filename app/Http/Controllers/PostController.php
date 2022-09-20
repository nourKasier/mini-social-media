<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::withCount('comments')->withCount('reactions')->inRandomOrder()->get();
        if(!is_null($posts)){
        return view('user.home')->with(['posts' => $posts]);
        }
        else
        {dd('there is no posts yet.');}
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
        return view('user.createPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['picture'] = uniqueNameAndMove($data['picture'], 'my_posts/images');
        $postData = Post::create($data);
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
        // show the edit form and pass the post
        return view('user.editPost')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
            if (! Gate::allows('update-post', $post)) {
                abort(403);
            }

            $data = $request->validated();
            //dd($data);
            $post->title = $data['edit_post_title'];
            $post->content = $data['edit_post_content'];
            if(array_key_exists("edit_post_picture", $data)){
                $post->picture = uniqueNameAndMove($data['edit_post_picture'], 'my_posts/images');
            }
            $post->save();
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (! Gate::allows('delete-post', $post)) {
            abort(403);
        }
        // delete
        $post->delete();

        // redirect
        //Session::flash('message', 'Successfully deleted the post!');
        //return Redirect::to('posts');
        return back();
    }
}
