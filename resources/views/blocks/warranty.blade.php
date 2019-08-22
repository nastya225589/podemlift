<ul class="warranty__list">
    @if($product->warranty)    
        {!! $product->warranty !!}
    @else
        <li class="warranty__item">
            <img class="warranty__img" src="/images/icon/file.svg" alt="">
            <span class="warranty__name">Гарантийный срок (стандартный)</span>
            <div class="warranty__dots">
                <div class="warranty__dot"></div>
                <span>24 мес</span>
            </div>
        </li>

        <li class="warranty__item warranty__item--file2">
            <img class="warranty__img" src="/images/icon/file2.svg" alt="">
            <span class="warranty__name">Гарантийный срок (расширенный*)</span>
            <div class="warranty__dots">
                <div class="warranty__dot"></div>
                <span>24 мес</span>
            </div>
            <small class="warranty__text">*- расширенный гарантийный срок предоставляется на оборудование при условии заключения Договора с производителем на ежемесячное техническое обслуживание</small>
        </li>
    @endif
</ul>
