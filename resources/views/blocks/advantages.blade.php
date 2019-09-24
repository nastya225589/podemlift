@php ($advantages = $page->collection('advantages'))
<section class="advantages">
    <h2 class="title-h2 advantages__title">Наши преимущества</h2>
    <div class="advantages__list">
        @foreach ($advantages as $key => $item)
            <div class="advantages__item">
                <span class="advantages__number">{{ ($key + 1 < 10) ? ('0' . strval($key + 1)) : ($key + 1) }}</span>
                <span class="advantages__name">{{ $item }}</span>
            </div> 
        @endforeach
    </div>
</section>
