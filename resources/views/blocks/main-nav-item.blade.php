<li class="main-nav__item {{ $menuItem->childrens->count() ? 'main-nav__item--submenu' : '' }}">
    <div class="main-nav__link">
        <a href="{{ $menuItem->url }}">
            {{ $menuItem->name_in_menu ?: $menuItem->name }}
        </a>
        <button class="btn-arrow main-nav__btn"></button>
    </div>

    @if($menuItem->childrens->count())
        <div class="submenu">
            <ul class="submenu__list">
                @foreach($menuItem->childrens as $subMenu)
                    <li class="submenu__item">
                        <a href="{{ $subMenu->url }}" class="submenu__link">
                            {{ $subMenu->name_in_menu ?: $subMenu->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</li>
