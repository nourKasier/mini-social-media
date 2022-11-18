<?php

namespace Application\Comments\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Application\Comments\Requests\StoreCommentReplyRequest;
use Application\Comments\Requests\StoreCommentRequest;
use Domain\Comments\Actions\CreateCommentAction;
use Domain\Comments\Actions\ShowCommentsForThisPostAction;
use Domain\Comments\Actions\ShowRepliesForThisCommentAction;
use Domain\Comments\Actions\StoreReplyForThisCommentAction;
use Illuminate\Http\Request;

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
        $created = new ShowCommentsForThisPostAction();
        $comments = $created->execute($id);
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
        $stored = new CreateCommentAction();
        $response = $stored->execute($request, $post_id, $this->comment);
        return back();
    }

    public function showReplies($post_id, $comment_id)
    {
        $showed = new ShowRepliesForThisCommentAction();
        $comments = $showed->execute($comment_id);
        return view('user.commentReplies')->with('comments', $comments);
    }

    public function storeReply(StoreCommentReplyRequest $request, $post_id, $comment_id)
    {
        $stored = new StoreReplyForThisCommentAction();
        $response = $stored->execute($request, $comment_id, $this->comment);
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
