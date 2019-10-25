<ul class="specifications__list">
    <h4>Основные характеристики</h4>
    @foreach($product->properties()->where('is_additional', false)->get() as $prop)
        <li class="specifications__item">
            <img class="specifications__img" src="{{ isset($prop->image) ? $prop->image->url : '/images/icon/warranty.svg' }}" alt="">
            <span class="specifications__name">{{ $prop->name }}</span>
            <div class="specifications__dots">
                <div class="specifications__dot"></div>
                <span>{{ $prop->value . ' ' . $prop->measure }}</span>
            </div>
        </li>
    @endforeach
    @php ($additional = $product->properties()->where('is_additional', true)->get())
    @if (count($additional))
        <h4>Дополнительные характеристики</h4>
        @foreach($product->properties()->where('is_additional', true)->get() as $prop)
            <li class="specifications__item">
                <img class="specifications__img" src="{{ isset($prop->image) ? $prop->image->url : '/images/icon/warranty.svg' }}" alt="">
                <span class="specifications__name">{{ $prop->name }}</span>
                <div class="specifications__dots">
                    <div class="specifications__dot"></div>
                    <span>{{ $prop->value . ' ' . $prop->measure }}</span>
                </div>
            </li>
        @endforeach
    @endif
</ul>
