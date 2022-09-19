@extends('user.layouts.navbar')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <form> action="{{url('createPost')}}"--}}
            {{-- <form method="POST" action="{{route('createPost')}}" enctype="multipart/form-data"> --}}
            <form name="createPost" id="createPost" method="post" action="{{route('createPost')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title"><strong>Post title:</strong></label>
                    <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Enter post title" value="{{ old('post_title') }}">
                </div>
                <div class="form-group">
                    <label for="content"><strong>Post content:</strong></label>
                    <textarea class="form-control" id="post_content" name="post_content" rows="4" placeholder="Enter post content">{{ old('post_content') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="picture"><strong>Post picture:</strong></label>
                    <input type="file" class="form-control-file" id="post_picture" name="post_picture">
                </div>
                <button type="submit" id="subCreatePost" class="btn btn-primary" style="margin-bottom: 10px;">Submit</button>
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

            {{-- <input type="text" name="title" value="{{ old('title') }}"> --}}
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
