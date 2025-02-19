<div>
    @foreach($passwords as $pass):
        <p>
            {{$pass->site_url}}
            <a href="{{ route('passwords.edit', $pas->id) }}"> Edit </a>
        </p>
    @endforeach
</div>