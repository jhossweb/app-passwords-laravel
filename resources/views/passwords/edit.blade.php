
<form action="{{ route('passwords.update') }}" method="post">
    @csrf() @method('PUT')
    <div>
        <input type="text" name="title_site" value="{{ old('title_site', $passwords->title_site) }}">
    </div>
    <div>
        <input type="text" name="site_url" value="{{ old('site_url', $passwords->site_url) }}">
    </div>
    <div>
        <input type="text" name="gen_password" value="{{ old('gen_password', $passwords->gen_password) }}">
    </div>
    <div>
        <input type="submit" value="update">
    </div>
</form>