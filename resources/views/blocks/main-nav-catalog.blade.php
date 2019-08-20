<?php
    $productCategories = \App\Models\ProductCategory::where('parent_id', null)->published()->sorted()->get();
    $mainProductCategories = $productCategories->slice(0, 5);
    $secondProductCategories = $productCategories->slice(5);
?>

<li class="main-nav__item main-nav__item--catalog">
    <div class="main-nav__link">
        <a class="main-nav__link--main" href="{{ $menuItem->url }}">
            {{ $menuItem->name_in_menu ?: $menuItem->name }}
        </a>
        <button class="btn-arrow main-nav__btn"></button>
    </div>

    <div class="submenu">
        <div class="submenu__wrap">
            @foreach($mainProductCategories as $productCategory)
                <ul class="submenu__list">
                    <li class="submenu__item submenu__item--head submenu__item--arrow">
                        <div class="submenu__link">
                            <a class="submenu__link--head" href="{{ $productCategory->url }}">
                                {{ $productCategory->name }}
                            </a>
                            <button class="btn-arrow submenu__btn"></button>
                        </div>
                        <div class="submenu-lev2">
                            <ul class="submenu__list">
                                @foreach($productCategory->childrens()->sorted()->get() as $productSubCategory)
                                    <li class="submenu__item">
                                        <a class="submenu__link" href="{{ $productSubCategory->url }}">{{ $productSubCategory->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
        <ul class="submenu__wrap submenu__list submenu__list--bottom">
            @foreach($secondProductCategories as $productCategory)
                <li class="submenu__item">
                    <a class="submenu__link submenu__link--head" href="{{ $productCategory->url }}">
                        {{ $productCategory->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</li>
