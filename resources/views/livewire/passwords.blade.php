<div class=" ">
    <x-action-section>
        <x-slot name="content">
            @foreach($passwords as $pass):
                <li>
                    {{ $pass->title_site }}
                </li>
            @endforeach
        </x-slot>
    </x-action-section>
</div>
