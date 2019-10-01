<?php
    $works = \App\Models\Work::inRandomOrder()->limit(10)->get();
    while ($works->count() < 6) {
        $more = \App\Models\Work::inRandomOrder()->limit(10)->get();
        $works = collect(array_merge($works->all(), $more->all()));
    }
?>

<section class="examples">
    <div class="container">
        <div class="examples__title title-h2">Примеры работ</div>
        <div class="examples__list">
            @foreach($works as $work)
                <div class="examples__item">
                    <img src="{{ $work->firstImage()->size(180, 300)->url }}" alt="photo" class="examples__photo" width="180" height="300">
                    <p class="examples__desc">
                        {{ $work->introtext ?: $work->name }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
