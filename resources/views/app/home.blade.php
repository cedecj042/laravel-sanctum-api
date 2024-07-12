@extends('index')
@section('page-title', 'Home')

@section('page-content')
<div class="container ">

</div>
<div class="container p-3">
    <div class="row bg-white px-5 py-4 mb-3 rounded shadow-sm">
        @include('app.post.createPost')
    </div>
    <br>
    <h1>All Posts</h1>
    @foreach ($posts as $post)
        <div class="row bg-white rounded shadow-sm px-5 py-4 my-3">
            <div class="row mb-3">
                <div class="col d-flex flex-col gap-2">
                    <div
                        style="width:40px;height:40px;border-radius:50px;background-color:#f0f0f0;border:1px solid rgba(0,0,0,0.12);">
                    </div>
                    <div class="row">
                        <label for="id">{{$post->user->name}}</label>
                        <label for="id"
                            style="font-size:12px;">{{ date('F d, Y h:i A', strtotime($post->updated_at)) }}</label>
                    </div>
                </div>

            </div>
            <a href="/post/{{$post->id}}">
                <h4>{{$post->title}}</h4>
            </a>
            <textarea disabled>{{ $post->body }}</textarea>
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
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/comment/edit/{{$comment->id}}">Edit</a></li>
                                        <li>
                                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <input type="hidden" name="redirect_to" value="home">
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
            </div>
            @if (auth()->check())
                <form action="{{ route('comment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="redirect_to" value="home">
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
    @endforeach
</div>

@endsection