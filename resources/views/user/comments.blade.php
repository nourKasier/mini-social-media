@extends('user.layouts.navbar')

<link href="{{ asset('css/comment-page/style.css') }}" rel="stylesheet" type="text/css">

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <div class="d-flex flex-column comment-section">
                <div id="comments_container" class="bg-white p-2">
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
                                <div class="p-2" style="margin-top: -25px; font-size:13;"><a href="/posts/{{request()->route('postId')}}/comments/{{$comment->id}}">Replies</a></div>
                            </div>
                            {{-- <input name="commentId_{{$comment->id}}" type="hidden" value={{$comment->id}}> --}}
                            {{-- <input name="commentId" type="hidden" value={{$comment->id}}> --}}
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
                        <textarea id="content" name="content" class="form-control ml-1 shadow-none textarea" placeholder="Leave a comment..."></textarea>
                    </div>
                    <div class="mt-2 text-right">
                        <button class="btn btn-primary btn-sm shadow-none" type="button" id="postComment" name="postComment">Post comment</button>
                        <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" id="back" name="back" type="button">Back</button>
                    </div>
                </div>
            </div>
            <div id="validation-errors" style="margin-top: 10px;"></div>
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
                //window.history.back();
                window.location.href = "{{URL::to('posts')}}"
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
    let current_user = '{{Auth::user()->name;}}';
    let post_id = {{request()->route('postId')}};
    let content = document.getElementById('content').value;
    e.preventDefault();

    let url = "{{ route('newComment', ':postId') }}";
    url = url.replace(':postId', post_id);
    $.ajax({
        type:'POST',
        data: {
            _token:'{{ csrf_token() }}',
            'content' : content,
        },
        url: url,
        success:function(data){
            if($.isEmptyObject(data.error)){
                // let comment_id = 1;
                // if(0) {comment_id = 5;} else {comment_id = 2;}
                let newdiv1 = $('<div class="d-flex flex-row user-info"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40"><div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">' + current_user + '</span></div></div><div class="mt-2"><p class="comment-text">' + content + '</p> <div class="p-2" style="margin-top: -25px; font-size:13;"><a href="#">Replies</a></div>');
                $(comments_container).append(newdiv1);
                let content_text_area = document.getElementById('content');
                content_text_area.value = '';
                location.reload();
            }else{
                alert("something went wrong please try again.");
            }
        },

        error: function (xhr) {
            $('#validation-errors').html('');
            $.each(xhr.responseJSON.errors, function(key,value) {
                $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div>');
            });
        },

    });
});

</script>

@endsection
