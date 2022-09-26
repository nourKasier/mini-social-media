<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\CommentReply\StoreCommentReplyRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

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
    public function create($id)
    {
        $comments = Comment::where('post_id', $id)->get();
        return view('user.comments')->with('comments', $comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request, $post_id)
    {
        //store via ajax
        // $user_id = $request->user()->id;
        // $comment = new Comment();
        // $comment->user_id = $user_id;
        // $comment->post_id = $post_id;
        // $comment->reply_to = null;
        // $comment->content =  $request->get('content');
        // $comment->save();
        // return response()->json(['success' => 'Comment added successfully.']);

        //
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['post_id'] = $post_id;
        $commentData = $this->comment->create($data);
        return back();
        //return response()->json(['success' => 'Comment added successfully.']);
    }

    public function showReplies($post_id, $comment_id)
    {
        $comments = Comment::where('reply_to', $comment_id)->get();
        return view('user.commentReplies')->with('comments', $comments);
    }

    public function storeReply(StoreCommentReplyRequest $request, $post_id, $comment_id)
    {
        //store via ajax
        // $user_id = $request->user()->id;
        // $comment = new Comment();
        // $comment->user_id = $user_id;
        // $comment->post_id = null;
        // $comment->reply_to = $comment_id;
        // $comment->content =  $request->get('content');
        // $comment->save();
        // return response()->json(['success' => 'Comment reply added successfully.']);

        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['reply_to'] = $comment_id;
        $commentData = $this->comment->create($data);
        return back();

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
