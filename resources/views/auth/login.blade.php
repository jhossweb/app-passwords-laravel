<form action="{{ route('auth.signin') }}" method="POST">
    @csrf
    <div>
        <input type="email" name="email" id="">
    </div>

    <div>
        <input type="password" name="password">
    </div>

    <div>
        <button type="submit">Sign In</button>
    </div>
</form>