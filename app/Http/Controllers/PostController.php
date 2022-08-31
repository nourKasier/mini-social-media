<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
        //$posts = DB::table('posts')->inRandomOrder()->get();
        //$posts = Post::all();
        //$posts = Post::with('user:id,name')->inRandomOrder()->get();//good
        $posts = Post::with('user:id,name')->withCount('comments')->withCount('reactions')->inRandomOrder()->get();
        //$posts = Post::withCount('comments')->get();
        //$posts = Post::getTotalLikesAttribute();
        //dd($posts);
        if(!is_null($posts)){
        return view('user.home')->with(['posts' => $posts])->with(['userId'=>$userId]);
        dd($posts);
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
        $userId = Auth::id();
        DB::table('posts')->insert([
            'user_id'   => $userId,
            'title' => $request->postTitle,
            'content' => $request->postContent,
            'picture' => $request->postPicture,
            'created_at'  => now(),
            'updated_at'  => now()
        ]);
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
