<form action="{{ route('auth.signin') }}" method="POST">
    @csrf
    <div>
        <input type="email" name="email">
    </div>
    <div>
        <input type="password" name="password">
    </div>
    
    <div>
        <input type="submit" value="Sign In">
    </div>  
</form>