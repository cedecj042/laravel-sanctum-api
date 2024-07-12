<form action="{{ route('post.store')}}" method="POST">
    @csrf
    <div class="mb-3 d-flex flex-col gap-3">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3 d-flex flex-col gap-3">
        <label for="body">Post</label>
        <textarea type="text" class="form-control" id="body" name="body"></textarea>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary rounded px-3">Post</button>
    </div>
</form>