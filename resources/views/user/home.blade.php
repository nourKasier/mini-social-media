@extends('user.layouts.navbar')

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

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
<h5 class="d-inline">{{$post->comments_count}} comments</h5>
<h5 class="d-inline float-right">{{$post->reactions_count}} likes</h5>
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
                <form name="unlikePost" class="mx-auto" id="unlikePost" method="post" action="{{route('unlikePost')}}">
                <a class="col-xs-4 mx-auto link" href="/unlikePost/{{$post->id}}">
                    <i class="fas fa-thumbs-up fa-lg justify-content-center like" style="font-size: 30px;"></i>
                </a>
                </form>
                @else
                <form name="likePost" class="mx-auto" id="likePost" method="post" action="{{route('likePost')}}">
                <a class="col-xs-4 mx-auto link" href="/likePost/{{$post->id}}">
                    <i class="fas fa-thumbs-up fa-lg justify-content-center unlike" style="font-size: 30px;"></i>
                </a>
                {{-- <input name="postId" type="hidden" value={{$post->id}}> --}}
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
<hr style="margin-top: 0rem;
margin-bottom: 0rem;
border: 0;
border-top: 5px solid #e1dada;"/>

@endforeach

@endsection
