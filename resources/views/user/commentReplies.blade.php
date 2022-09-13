@extends('user.layouts.navbar')

<link href="{{ asset('css/comment-page/style.css') }}" rel="stylesheet" type="text/css">

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <div class="d-flex flex-column comment-section">
                <div id="commentsContainer" class="bg-white p-2">
                        @forelse ($comments as $comment)
                            <div class="d-flex flex-row user-info" style="margin-top: 10px;">
                                <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40">
                                <div class="d-flex flex-column justify-content-start ml-2">
                                    {{-- <span class="d-block font-weight-bold name">Marry Andrews</span> --}}
                                    <span class="d-block font-weight-bold name" style="margin-top: 8px;">{{$comment->user->name}}</span>
                                    {{-- <span class="date text-black-50">Shared publicly - Jan 2020</span> --}}
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="comment-text">{{$comment->content}}</p>
                                {{-- <div class="like p-2 cursor" style="margin-top: -20px; font-size:13;"><i class="fa fa-commenting-o"></i><span class="ml-1">Reply</span></div> --}}
                            </div>
                        @empty
                        @endforelse
                </div>
                {{-- <div class="bg-white">
                    <div class="d-flex flex-row fs-12">
                        <div class="like p-2 cursor"><i class="fa fa-thumbs-o-up"></i><span class="ml-1">Like</span></div>
                        <div class="like p-2 cursor"><i class="fa fa-commenting-o"></i><span class="ml-1">Comment</span></div>
                        <div class="like p-2 cursor"><i class="fa fa-share"></i><span class="ml-1">Share</span></div>
                    </div>
                </div> --}}
                <div class="bg-light p-2">
                    <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40">
                        <textarea id="commentContent" class="form-control ml-1 shadow-none textarea" placeholder="Leave a reply..."></textarea>
                    </div>
                    <div class="mt-2 text-right">
                        <button class="btn btn-primary btn-sm shadow-none" type="button" id="postComment" name="postComment">Post reply</button>
                        <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" id="back" name="back" type="button">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#back").click(function(e){
    e.preventDefault();
    $.ajax({
        type:'get',
        url: "/posts",
        success:function(data){
            if($.isEmptyObject(data.error)){
                window.history.back();
            }else{
                alert("something went wrong please try again.");
            }
        }
    });
});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("#postComment").click(function(e){
    let currentUser = '{{Auth::user()->name;}}';
    let post_id = {{request()->route('postId')}};
    let comment_id = {{request()->route('commentId')}};
    let commentContent = document.getElementById('commentContent').value;
    e.preventDefault();

    let url = "{{ route('newCommentReply', [':post_id',  ':comment_id']) }}";
    url = url.replace(':post_id', post_id);
    url = url.replace(':comment_id', comment_id);
    $.ajax({
        type:'POST',
        data: {
            _token:'{{ csrf_token() }}',
            'commentContent' : commentContent,
        },
        url: url,
        success:function(data){
            if($.isEmptyObject(data.error)){
                var newdiv1 = $('<div class="bg-white p-2"><div class="d-flex flex-row user-info"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"><div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">' + currentUser + '</span></div></div><div class="mt-2"><p class="comment-text">' + commentContent + '</p></div>');
                $(commentsContainer).append(newdiv1);
                let commentContentTextArea = document.getElementById('commentContent');
                commentContentTextArea.value = '';
            }else{
                alert("something went wrong please try again.");
            }
        }
    });
});

</script>

@endsection
