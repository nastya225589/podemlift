<nav class="sidebar">
    <ul class="sidebar__list">
        @foreach(\App\Models\ProductCategory::where('parent_id', null)->published()->sorted()->get() as $productCategory)
            <li class="sidebar__item">
                <div class="sidebar__link">
                    <a href="{{ $productCategory->url }}">
                        {{ $productCategory->name }}
                    </a>
                    <button class="btn-arrow sidebar__btn"></button>
                </div>

                @if($productCategory->childrens()->count())
                    <div class="sidebar-submenu">
                        <ul class="sidebar-submenu__list">
                            @foreach($productCategory->childrens()->published()->sorted()->get() as $productSubCategory)
                                <li class="sidebar-submenu__item">
                                    <a class="sidebar-submenu__link" href="{{ $productSubCategory->url }}">
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
