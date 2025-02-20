<form action="{{ route('auth.signup') }}" method="POST">
    @csrf 
    <div>
        <input type="text" name="name">
    </div>
    <div>
        <input type="email" name="email">
    </div>
    <div>
        <input type="password" name="password">
    </div>
    
    <div>
        <input type="submit" value="Sign Up">
    </div>  
</form>