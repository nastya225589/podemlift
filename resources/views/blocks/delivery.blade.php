<div class="delivery">
    @if($product->delivery)    
        {!! $product->delivery !!}
    @else
        <p class="delivery__text delivery__text--improvement">Заказать подъемное оборудования можно с доставкой и с монтажом или произвести данные работы своими силами по предоставляемым подробным схемам монтажа, которые в обязательном порядке входят в комплект поставки.</p>
    @endif
</div>
