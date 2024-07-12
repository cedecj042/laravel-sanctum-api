@extends('index')

@section('page-content')
<div class="container">
    <h1>Edit Post</h1>

    <form action="{{ route('post.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
        </div>
        <div class="mb-3">
            <label for="body">Post</label>
            <textarea class="form-control" id="body" name="body" required>{{ $post->body }}</textarea>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary rounded-pill px-3">Update Post</button>
        </div>
    </form>
</div>
@endsection
