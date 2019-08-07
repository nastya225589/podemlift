<section class="tabs">
    <div id="tabs" class="only-desktop">
        <div class="container">
            <ul class="tabs__list">
                <li class="tabs__item">
                    <a href="#tabs-1" class="tabs__link">Информация об оборудовании</a>
                </li>
                <li class="tabs__item">
                    <a href="#tabs-2" class="tabs__link">Технические характеристики</a>
                </li>
                <li class="tabs__item">
                    <a href="#tabs-3" class="tabs__link">Гарантия</a>
                </li>
                <li class="tabs__item">
                    <a href="#tabs-4" class="tabs__link">Доставка и монтаж</a>
                </li>
                <li class="tabs__item">
                    <a href="#tabs-5" class="tabs__link">Похожие товары</a>
                </li>
            </ul>

            <div id="tabs-1">
                @include('blocks.product-inform')
            </div>
            <div id="tabs-2">
                @include('blocks.specifications')
            </div>
            <div id="tabs-3">
                @include('blocks.warranty')
            </div>
            <div id="tabs-4">
                @include('blocks.delivery')
            </div>
            <div id="tabs-5">
                <div class="products__wrap">
                    @foreach(\App\Models\Product::limit(8)->get() as $product)
                        @include('blocks.card')
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div id="tabs-mobile" class="only-mobile">
        <div class="tabs__list">
            <div class="tabs__item">
                <a href="#" class="tabs__link">Информация об оборудовании</a>
                <div class="tabs__block">
                    @include('blocks.product-inform')
                </div>
            </div>
            <div class="tabs__item">
                <a href="#" class="tabs__link">Технические характеристики</a>
                <div class="tabs__block">
                    @include('blocks.specifications')
                </div>
            </div>
            <div class="tabs__item">
                <a href="#" class="tabs__link">Гарантия</a>
                <div class="tabs__block">
                    @include('blocks.warranty')
                </div>
            </div>
            <div class="tabs__item">
                <a href="#" class="tabs__link">Доставка и монтаж</a>
                <div class="tabs__block">
                    @include('blocks.delivery')
                </div>
            </div>
            <div class="tabs__item">
                <a href="#" class="tabs__link">Похожие товары</a>
                <div class="tabs__block">
                    <div class="container">
                        <?php $products = \App\Models\Product::all() ?>
                        <div class="products__wrap">
                            @foreach($products as $product)
                                @include('blocks.card')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <section>
                @include('blocks.form')
            </section>
        </div>
    </div>
</section>
