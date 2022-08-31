@extends('user.layouts.navbar')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <form> action="{{url('createPost')}}"--}}
            {{-- <form method="POST" action="{{route('createPost')}}" enctype="multipart/form-data"> --}}
            <form name="createPost" id="createPost" method="post" action="{{route('createPost')}}">
                @csrf
                <div class="form-group">
                    <label for="title"><strong>Post title:</strong></label>
                    <input type="text" class="form-control" id="postTitle" name="postTitle" placeholder="Enter post title" required>
                </div>
                <div class="form-group">
                    <label for="content"><strong>Post content:</strong></label>
                    <textarea class="form-control" id="postContent" name="postContent" rows="4" placeholder="Enter post content" required></textarea>
                </div>
                <div class="form-group">
                    <label for="picture"><strong>Post picture:</strong></label>
                    <input type="file" class="form-control-file" id="postPicture" name="postPicture" required>
                </div>
                <button type="submit" id="subCreatePost" class="btn btn-primary">Submit</button>
            </form>


            {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div> --}}
        </div>
    </div>
</div>

@endsection
