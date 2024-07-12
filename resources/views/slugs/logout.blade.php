<form action="{{ route('logout') }}" class="d-inline-block">
    @csrf
    <button type="submit" class="btn btn-sm btn-danger m-2" >
        Logout
    </button>
</form>
