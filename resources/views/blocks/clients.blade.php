<?php
    $clients = \App\Models\Client::inRandomOrder()->limit(10)->get();
    while ($clients->count() < 14) {
        $more = \App\Models\Client::inRandomOrder()->limit(10)->get();
        $clients = collect(array_merge($clients->all(), $more->all()));
    }
?>
<section class="clients">
    <div class="clients__title title-h2">Заказчики</div>
    <div class="clients__wrap">
        <div class="container">
            <div class="clients__list">
                @foreach($clients->chunk(2) as $chunk)
                    <div class="clients__item">
                        @foreach($chunk as $item)
                            <img src="{{ $item->image->size(null, 60)->url }}" alt="" class="clients__icon">
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
