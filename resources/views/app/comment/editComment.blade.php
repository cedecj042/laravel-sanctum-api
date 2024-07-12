@extends('index')

@section('page-content')
<div class="container">
    <h1>Edit Comment</h1>
    <form action="{{ route('comment.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="body"
                style="height: 90px" required>{{ $comment->body }}</textarea>
            <label for="floatingTextarea2">Edit Comment</label>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mt-3" type="submit">Update Comment</button>
        </div>
    </form>
</div>
@endsection
