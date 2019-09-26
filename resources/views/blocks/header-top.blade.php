<div class="header-top">
    <div class="container">
        <div class="header-top__wrap">
            @include('blocks.logo')

            @include('blocks.contacts')

            <div class="header-top__buy">
                <svg width="38" height="38">
                    <use xlink:href="/images/icon/sprite.svg#header-request"></use>
                </svg>
                <a href="#form-popup" class="header-top__order">
                    <span>СДЕЛАТЬ ЗАКАЗ</span>
                    <p>мы рассчитаем ваш заказ по техническому заданию</p>
                </a>
            </div>
            @include('blocks.form-popup')

            <button class="main-nav__toggle">
                <span></span>
            </button>
        </div>
    </div>
</div>
