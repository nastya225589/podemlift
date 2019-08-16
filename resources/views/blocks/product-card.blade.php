<div class="product-card">
    <div class="container">
        <h1 class="product-card__title title-h1">{{ $page->name }}</h1>
        <div class="product-card__wrapper">
            <div class="product-card__slider">
                <div class="product-card__proto">
                    @foreach($page->images() as $image)
                        <div class="product-card__img">
                            <img src="{{ $image->url }}" alt="">
                        </div>
                    @endforeach
                </div>
                <div class="product-card__proto-nav">
                    @foreach($page->images() as $image)
                        <div class="product-card__img">
                            <img src="{{ $image->url }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="product-card__desc">
                <div class="product-card__price">от <span>{{ $page->price }}</span> руб</div>
                <p class="product-card__text">Цена приведена с учетом минимальной грузоподъемности и высоты подъема на данный тип оборудования.</p>
                <p class="product-card__text">Чтобы узнать полную стоимость нажмите кнопку «Заказать» или заполните и отправьте опросный лист. Наш специалист свяжется с Вами в течение дня.</p>
                <button class="btn product-card__btn">Заказать</button>
                <button class="btn product-card__btn-sheet">Заполнить опросный лист</button>
            </div>
        </div>
    </div>
</div>
