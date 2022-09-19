@extends('user.layouts.navbar')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form name="editPost" id="editPost" method="post" action="{{route('posts.update', ['post'=> $post])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title"><strong>Post title:</strong></label>
                    <input type="text" class="form-control" id="edit_post_title" name="edit_post_title" placeholder="Enter post title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="content"><strong>Post content:</strong></label>
                    <textarea class="form-control" id="edit_post_content" name="edit_post_content" rows="4" placeholder="Enter post content">{{ $post->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="picture"><strong>Post picture:</strong> (note, leave this field empty -No file chosen- if you do not want to change your post picture).</label>
                    <input type="file" class="form-control-file" id="edit_post_picture" name="edit_post_picture">
                </div>
                <button type="submit" id="subEditPost" class="btn btn-primary" style="margin-bottom: 10px;">Submit</button>
                <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" id="back" name="back" type="button" onclick="location.href='/posts';" style="width: 76px; height: 38px; margin-top: -8px;">Back</button>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>

        </div>
    </div>
</div>

@endsection
