<?php

$menu = \App\Models\Page::published()->where('in_menu', true)->where('parent_id', null)->orderBy('sort')->get();

?>
<nav class="main-nav" id="nav">
    <div class="container">
        <ul class="main-nav__list">
            @foreach($menu as $menuItem)
                @if($menuItem->behavior == 'catalog')
                    @include('blocks.main-nav-catalog')
                @else
                    @include('blocks.main-nav-item')
                @endif
            @endforeach
        </ul>
    </div>
</nav>
