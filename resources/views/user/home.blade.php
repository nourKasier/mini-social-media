@extends('user.layouts.navbar')

@section('content')

@foreach ($posts as $post)
<ul class="navbar-nav flex-row">
    <li class="nav-item me-3 me-lg-1">
        <a class="nav-link d-sm-flex align-items-sm-center" href="#" style="margin-left: 30%; width:100%;">
        <img
            src="https://mdbcdn.b-cdn.net/img/new/avatars/1.webp"
            class="rounded-circle"
            height="50"
            alt="Black and White Portrait of a Man"
            loading="lazy"
        />
        <strong class="d-none d-sm-block ms-1" style="font-size:20px;"> {{$post->user->name}}</strong>
        {{-- <strong class="d-none d-sm-block ms-1" style="font-size:20px;"> /{{ $post->isAuthUserLikedPost() ? '1' : 'else' }}</strong> --}}
        </a>
    </li>
</ul>
<p class="text-justify" style="margin: 1% 1% 0 1%;"><strong>{{$post->title}}</strong></p>
<p class="text-justify" style="margin: 1% 1% 1% 1%;">{{$post->content}}</p>
<img src="images/post.jpg" class="img-fluid " alt="Responsive image" style="height: 320px; width: auto;display:block; margin:auto;">
<h5 class="d-inline" id="commentsCount_{{$post->id}}">{{$post->comments_count}} comments</h5>
<h5 class="d-inline float-right" id="reactionsCount_{{$post->id}}">{{$post->reactions_count}} likes</h5>
<hr style="margin-top: 0rem;
margin-bottom: 1%;
border: 0;
border-top: 2px solid #e1dada;"/>

<div class='container-fluid'>
    <div class='row'>
        <div class='col'>
            <div class='row' >
                <a class="col-xs-4 mx-auto" href="/posts/{{$post->id}}/comments">
                    <span><i class="fas fa-comment-alt fa-lg justify-content-center comment-icon" style="font-size: 30px;"></i></span>
                </a>

            </div>
        </div>
        <div class='col'>
            <div class='row'>
                @if($post->isAuthUserLikedPost())

                    <a id="postId_{{$post->id}}" class="col-xs-4 mx-auto link like-link like" href="#">
                    <i class="fas fa-thumbs-up fa-lg justify-content-center " style="font-size: 30px;"></i>
                </a>

                @else

                    <a id="postId_{{$post->id}}" class="col-xs-4 mx-auto link like-link unlike" href="#">
                    <i class="fas fa-thumbs-up fa-lg justify-content-center " style="font-size: 30px;"></i>
                </a>
                {{-- <input name="postId" type="hidden" value={{$post->id}}> --}}

                @endif
            </div>
        </div>
    </div>
</div>
<hr style="margin-top: 0.5rem;
margin-bottom: 0rem;
border: 0;
border-top: 5px solid #e1dada;"/>

{{-- <input name="postId" type="hidden" data-post-id="{{$post->id}}"> --}}
@endforeach

<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(".like-link").click(function(e){
    let waypoint_id = this.getAttribute('id');
    let post_id = waypoint_id.split("_").pop();

    e.preventDefault();

    let url = "{{ route('posts.toggle', ':id') }}";
    url = url.replace(':id', post_id);
    $.ajax({
        type:'POST',
        url: url,
        success:function(data){
            if($.isEmptyObject(data.error)){
                var element = document.getElementById(waypoint_id);

                //for increase/decrease the likes count by one
                var str = "reactionsCount_" + post_id;
                var reactionsCountElement = document.getElementById(str);
                let count = reactionsCountElement.innerHTML.split(" ").shift();

                if (element.classList.contains("unlike")) {
                    element.classList.remove("unlike");
                    element.classList.add("like");

                    //increase the likes count by one
                    var st = parseInt(count)+1 + " likes";
                }else{
                    element.classList.remove("like");
                    element.classList.add("unlike");

                    //decrease the likes count by one
                    var st = parseInt(count)-1 + " likes";
                }
                reactionsCountElement.innerHTML = st;
            }else{
                alert("something went wrong please try again.");
            }
        }
    });
});
</script>

@endsection
