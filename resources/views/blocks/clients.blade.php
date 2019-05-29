<section class="clients">
    <h2 class="clients__title">Заказчики</h2>
    <div class="clients__wrap">
        <div class="container">
            <div class="clients__list">
                @foreach($clients->chunk(2) as $chunk)
                    <div class="clients__item">
                        @foreach($chunk as $item)
                            <img src="{{ $item->image->size(null, 70)->url }}" alt="" class="clients__icon">
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
