<?php

$menu = \App\Models\Page::published()->where('in_menu', true)->where('parent_id', null)->get();

?>
<nav class="main-nav" id="nav">
    <div class="container">
        <ul class="main-nav__list">

            @foreach($menu as $menuItem)
                <li class="main-nav__item main-nav__item--main">
                    <a class="main-nav__link" href="{{ $menuItem->url }}">
                        {{ $menuItem->name_in_menu ?: $menuItem->name }}
                    </a>
                    @if($menuItem->behavior == 'catalog')
                        @include('blocks.main-nav-catalog')
                    @endif
                </li>
            @endforeach

            {{--

            <li class="main-nav__item main-nav__item--main">
                <a class="main-nav__link main-nav__link--main" href="/">Kаталог</a>
                <div class="submenu">
                    <div class="submenu__wrap">
                        <ul class="submenu__list">
                            <li class="submenu__item submenu__item--head submenu__item--arrow">
                                <a class="submenu__link submenu__link--head" href="/">Трособлочные подъемники</a>
                                <div class="submenu-lev2">
                                    <ul class="submenu__list">
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Kаталог</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Производство</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Объекты</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Клиенты</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link " href="/">Услуги</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <ul class="submenu__list">
                            <li class="submenu__item submenu__item--head submenu__item--arrow">
                                <a class="submenu__link submenu__link--head" href="/">Краны</a>
                                <div class="submenu-lev2">
                                    <ul class="submenu__list">
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Kаталог</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Производство</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Объекты</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Клиенты</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link " href="/">Услуги</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <ul class="submenu__list">
                            <li class="submenu__item submenu__item--head submenu__item--arrow">
                                <a class="submenu__link submenu__link--head" href="/">Лифты</a>
                                <div class="submenu-lev2">
                                    <ul class="submenu__list">
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Kаталог</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Производство</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Объекты</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Клиенты</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link " href="/">Услуги</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <ul class="submenu__list">
                            <li class="submenu__item submenu__item--head submenu__item--arrow">
                                <a class="submenu__link submenu__link--head" href="/">Гидравлические подъемники</a>
                                <div class="submenu-lev2">
                                    <ul class="submenu__list">
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Kаталог</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Производство</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <ul class="submenu__list">
                            <li class="submenu__item submenu__item--head submenu__item--arrow">
                                <a class="submenu__link submenu__link--head" href="/">Прочее оборудование</a>
                                <div class="submenu-lev2">
                                    <ul class="submenu__list">
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Kаталог</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Производство</a>
                                        </li>
                                        <li class="submenu__item">
                                            <a class="submenu__link" href="/">Производство</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <ul class="submenu__wrap submenu__list submenu__list--bottom">
                        <li class="submenu__item">
                            <a class="submenu__link submenu__link--head" href="/">Уникальное грузоподъемное оборудование</a>
                        </li>
                        <li class="submenu__item">
                            <a class="submenu__link submenu__link--head" href="/">Наклонные грузовые подъемники</a>
                        </li>
                        <li class="submenu__item">
                            <a class="submenu__link submenu__link--head" href="/">Взрывозащищенное оборудование</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="main-nav__item">
                <a class="main-nav__link" href="/">О компании</a>
            </li>
            <li class="main-nav__item">
                <a class="main-nav__link" href="/">Производство</a>
            </li>
            <li class="main-nav__item">
                <a class="main-nav__link" href="/">Объекты</a>
            </li>
            <li class="main-nav__item">
                <a class="main-nav__link" href="/">Клиенты</a>
            </li>
            <li class="main-nav__item">
                <a class="main-nav__link" href="/">Услуги</a>
            </li>
            <li class="main-nav__item main-nav__item--submenu main-nav__item--arrow">
                <a class="main-nav__link" href="/">Полезные страницы</a>
                <div class="submenu">
                    <ul class="submenu__list">
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Импортозамещение подъемного оборудования</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Сравнительные характеристики подъемного оборудования</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Опросные листы для изготовления мачтовых подъемников и грузовых лифтов</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Универсальная форма расчета вашего оборудования</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Стоимость подъемного оборудования</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">История подъемного оборудования</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">FAQ</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="main-nav__item main-nav__item--arrow main-nav__item--submenu-sphere">
                <a class="main-nav__link" href="/">Сферы применения</a>
                <div class="submenu submenu__sphere">
                    <ul class="submenu__list">
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Банки</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Библиотеки</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Магазины</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Подъемники для зданий</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Подъемники для зоны отгрузки и погрузки</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Подъемники для монтажных, отделочных и окрасочных работ</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Рестораны и кафе</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Склады</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Строительство</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Школы и детские сады</a>
                        </li>
                        <li class="submenu__item">
                            <a href="" class="submenu__link">Подвалы и погреба</a>
                        </li>
                    </ul>
                </div>
            </li>

            --}}

        </ul>
    </div>
</nav>
