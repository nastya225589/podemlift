<ul class="specifications__list">
    @foreach($product->properties as $prop)
        <li class="specifications__item">
            <img class="specifications__img" src="{{ isset($prop->image) ? $prop->image->url : '/images/icon/weight-kg.svg' }}" alt="">
            <span class="specifications__name">{{ $prop->name }}</span>
            <div class="specifications__dots">
                <div class="specifications__dot"></div>
                <span>{{ $prop->value . ' ' . $prop->measure }}</span>
            </div>
        </li>
    @endforeach
</ul>
