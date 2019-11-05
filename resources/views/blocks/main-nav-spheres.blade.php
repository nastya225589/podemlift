@php ($spheres = App\Models\ApplicationSphere::published()->orderBy('name')->get())
<li class="main-nav__item {{ count($spheres) ? 'main-nav__item--submenu' : '' }}">
    <div class="main-nav__link">
        <a href="{{ $menuItem->url }}">
            {{ $menuItem->name_in_menu ?: $menuItem->name }}
        </a>
        @if(count($spheres))
            <button class="btn-arrow main-nav__btn"></button>
        @endif
    </div>

    @if(count($spheres))
        <div class="submenu">
            <ul class="submenu__list">
                @foreach($spheres as $subMenu)
                    <li class="submenu__item">
                        <a href="/sphere-item/{{ $subMenu->slug }}" class="submenu__link">
                            {{ $subMenu->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</li>
