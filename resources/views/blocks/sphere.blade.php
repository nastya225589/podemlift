@php ($spheres = \App\Models\ApplicationSphere::published()->get())

<section class="sphere">
    <div class="sphere__list">
        @foreach ($spheres as $key => $item)
            <a href="/sphere-item/{{ $item->slug }}" class="sphere__item">
                <span class="sphere__number">{{ ($key + 1 < 10) ? ('0' . strval($key + 1)) : ($key + 1) }}</span>
                <span class="sphere__name">{{ $item->name }}</span>
            </a> 
        @endforeach
    </div>
</section>
