<div>
    @foreach($pass as $pas):
        <p>
            {{$pas->site_url}}
            <a href="{{ route('passwords.edit', $pas->id) }}"> Edit </a>
        </p>
    @endforeach
</div>