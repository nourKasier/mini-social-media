<?php

namespace Application\Posts\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Application\Posts\Requests\StorePostRequest;
use Application\Posts\Requests\UpdatePostRequest;
use Domain\Posts\Actions\CreatePostAction;
use Domain\Posts\Actions\DeletePostAction;
use Domain\Posts\Actions\ToggleLikeAction;
use Domain\Posts\Actions\UpdatePostAction;
use Domain\Posts\DataTransferObjects\PostData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::withCount('comments')
            ->withCount('reactions')
            ->inRandomOrder()
            ->get();
        if (!is_null($posts)) {
            return view('user.home')->with(['posts' => $posts]);
        } else {
            echo 'there is no posts yet.';
        }
    }

    public function toggle(Request $request, $post_id)
    {
        $response = ToggleLikeAction::run($request, $post_id);
        return $response ? response()->json(['success' => 'Post liked/unliked successfully.']) :
            response()->json(['success' => 'Post did not liked/unliked successfully.']);
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
        $response = CreatePostAction::run(PostData::make($request));
        if ($response) {
            return back()->withSuccess('Post created successfully.');
        } else {
            return back()->withError('Post was not created successfully, please try again.');
        }
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
        if (!Gate::allows('update-post', $post)) {
            abort(403);
        }
        //$updated = new UpdatePostAction();
        //$response = $updated->execute($request, $post);
        // $response = UpdatePostAction::run($request, $post);
        $response = UpdatePostAction::run(PostData::update($request), $post);

        if ($response) {
            return back()->withSuccess('Post updated successfully.');
        } else {
            return back()->withError('Post was not updated successfully, please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (!Gate::allows('delete-post', $post)) {
            abort(403);
        }
        // delete
        // $deleted = new DeletePostAction();
        // $response = $deleted->execute($post);
        $response = DeletePostAction::run($post);

        if ($response) {
            return redirect('/posts')->withSuccess('Post deleted successfully.');
        } else {
            return redirect('/posts')->withError('Post was not deleted successfully, please try again.');
        }
    }
}
