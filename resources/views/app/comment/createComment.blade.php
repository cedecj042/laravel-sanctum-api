<form action="">
    @csrf
    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
            style="height: 90px"></textarea>
        <label for="floatingTextarea2">Enter a Comment</label>
    </div>
    <div class="d-flex justify-content-end">
    <button class="btn btn-primary mt-3" type="button">Comment</button>
    </div>
</form>