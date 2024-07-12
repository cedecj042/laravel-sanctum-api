@extends('index')

@section('page-content')
<br>
<div class="container">
    <a href="{{ route('home') }}" class="link-dark">Back</a>

    <div class="d-flex flex-col justify-content-between">
        <h1 class="w-40">{{ $post->title }}</h1>
        @if($post->user_id == Auth::user()->id)
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Options
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/post/edit/{{$post->id}}">Edit</a></li>
                    <li>

                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item"
                                onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    </div>
    <div class="row">
        <p style="font-size:14px;">By: {{ $post->user->name }}</p>
        <p style="font-size:18px;">{{ $post->body }}</p>
        <p style="font-size:14px;">Posted on: {{ $post->created_at->format('F d, Y h:i A') }}</p>
    </div>
    <hr>
    <h2>Comments</h2>
    <div class="comments">
        @foreach ($post->comments as $comment)
            <div class="comment px-4 py-3">
                <div class="d-flex flex-col justify-content-between">
                    <div class="col">
                        <h5>{{ $comment->user->name }}</h5>
                        <p style="font-size:12px;">{{$comment->created_at->format('F d, Y h:i A') }}</p>
                    </div>
                    @if($comment->user_id == Auth::user()->id)
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false"></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/comment/edit/{{$comment->id}}">Edit</a></li>
                                <li>
                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
                <p>{{ $comment->body }}</p>
            </div>
        @endforeach
        @if (auth()->check())
            <form action="{{ route('comment.store') }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="redirect_to" value="post">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="body"
                        style="height: 90px" required></textarea>
                    <label for="floatingTextarea2">Enter a Comment</label>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary mt-3" type="submit">Comment</button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection