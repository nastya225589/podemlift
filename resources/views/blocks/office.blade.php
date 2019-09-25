@php ($addresses = $page->collection('addresses'))
<section class="office">
    <h2 class="title-h2 office__title">Региональные офисы по продаже и монтажу оборудования</h2>
    <div class="office__list">
        @foreach ($addresses as $key => $item)
            <div class="office__item">
                <span class="office__number">{{ ($key + 1 < 10) ? ('0' . strval($key + 1)) : ($key + 1) }}</span>
                <span class="office__city">{{ $item->region }}</span>
                <span class="office__address">{{ $item->address }}</span>
                <a href="tel:{{ $item->phone }}" class="office__phone">{{ $item->phone }}</a>
            </div> 
        @endforeach
    </div>

    <button class="btn btn-dashed office__btn-dashed">Показать еще</button>
</section>
