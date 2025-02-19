<form action="{{ route('passwords.store') }}" method="post">
    @csrf()
    <div>
        <input type="text" name="title_site" >
    </div>
    <div>
        <input type="text" name="site_url" >
    </div>
    <div>
        <input type="text" name="gen_password" value="{{ $contraseña }}">
    </div>
    <div>
        <input type="submit" value="save">
    </div>
</form>