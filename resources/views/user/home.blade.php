@extends('user.layouts.navbar')

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@foreach ($posts as $post)
<ul class="navbar-nav flex-row" style="display: inline-block;">
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
<ul class="navbar-nav flex-row float-right">
    <div class="dropdown">
        <a class="btn btn-secondary" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black; background:white; border-color:white; margin-right: 10px; font-size: 23px;">
            <i class="fa fa-ellipsis-h"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="/posts/{{$post->id}}/edit">Edit</a>
            <a class="dropdown-item"
            href="{{ route('posts.destroy', ['post' => $post]) }}"
            onclick="event.preventDefault();
            document.getElementById('delete-form-{{ $post->id }}').submit();">
            Delete
            </a>
            <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', ['post' => $post]) }}"
            method="post" style="display: none;">
            @method('delete')
            @csrf
            </form>
        </div>
    </div>

</ul>
<p class="text-justify" style="margin: 1% 1% 0 1%;"><strong>{{$post->title}}</strong></p>
<p class="text-justify" style="margin: 1% 1% 1% 1%;">{{$post->content}}</p>
{{-- <img src="images/post.jpg" class="img-fluid " alt="Responsive image" style="height: 320px; width: auto;display:block; margin:auto;"> --}}
<img src="{{ asset('my_posts/images/' . $post->picture) }}" class="img-fluid " alt="image" style="height: 320px; width: auto; display:block; margin:auto;">
<h5 class="d-inline" id="commentsCount_{{$post->id}}">{{$post->comments_count}} comments</h5>
<h5 class="d-inline float-right" id="reactions_count_{{$post->id}}">{{$post->reactions_count}} likes</h5>
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
                var str = "reactions_count_" + post_id;
                var reactions_count_element = document.getElementById(str);
                let count = reactions_count_element.innerHTML.split(" ").shift();

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
                reactions_count_element.innerHTML = st;
            }else{
                alert("something went wrong please try again.");
            }
        }
    });
});
</script>

@endsection
