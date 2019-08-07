<article class="catalog-menu">
    <nav class="main-nav">
        <ul class="main-nav__list catalog-menu__list">
            @foreach(\App\Models\ProductCategory::where('parent_id', null)->published()->sorted()->get() as $productCategory)
                <li class="main-nav__item catalog-menu__item">
                    <a class="main-nav__link" href="{{ $productCategory->url }}">
                        {{ $productCategory->name }}
                    </a>

                    @if($productCategory->childrens()->count())
                        <div class="submenu catalog-menu__submenu">
                            <ul class="submenu__list">
                                @foreach($productCategory->childrens()->published()->sorted()->get() as $productSubCategory)
                                    <li class="submenu__item">
                                        <a class="submenu__link" href="{{ $productSubCategory->url }}">
                                            {{ $productSubCategory->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>

    @include('blocks.filter')
</article>
